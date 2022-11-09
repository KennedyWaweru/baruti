<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Http;

use AfricasTalking\SDK\AfricasTalking;

use App\Order;


class OrderPayment extends Component
{
    public $form_details;
    public $order_id;
    public $payment_phone;
    protected $listeners = ['checkTransactionStatus'];

    public function render()
    {
        return view('livewire.order-payment');
    }

    public function getAccessToken(){
        $consumer_key = env('MPESA_CONSUMER_KEY');
        $consumer_secret = env('MPESA_CONSUMER_SECRET');
        $auth_url = env('MPESA_AUTH_URL');
        $r = Http::withBasicAuth($consumer_key, $consumer_secret)->get($auth_url);
        $access_token = $r->json()['access_token'];
        return $access_token;
    }
    public function sendPaymentRequest(){
        $amount = (int)Cart::subtotal(0,'','');
        $amount_to_charge = $amount > 1000 ?: $amount + 500;
        $msisdn_mobile_num = chop($this->payment_phone);
        $msisdn_mobile_num = substr($msisdn_mobile_num,1);
        $payment_phone = '254'.$msisdn_mobile_num;
        $phone_num = $payment_phone;
        // TODO: move callback url to proper server
        $callback_url = env('MPESA_CALLBACK_URL');
        
        $shortcode = env('MPESA_SHORTCODE');
        $passkey = env('MPESA_PASSKEY');
        $timestamp = strftime("%Y%m%d%H%M%S",time());
        $raw_password = $shortcode.$passkey.$timestamp;
        $enc_pwd = base64_encode($raw_password);
        
        $access_token = $this->getAccessToken();
        $stk_push_url = env('MPESA_STK_PUSH_URL');
        $header = array('Authorization'=>'Bearer '.$access_token);
        $req_body = array(
          "BusinessShortCode"=>$shortcode,
          "Password"=> $enc_pwd,    
          "Timestamp"=>$timestamp,    
          "TransactionType"=> "CustomerBuyGoodsOnline",    
          //"Amount"=>$amount_to_charge, 
          "Amount"=>10,   
          "PartyA"=>$phone_num,    
          "PartyB"=>$shortcode,    
          "PhoneNumber"=>$phone_num,    
          "CallBackURL"=>$callback_url,    
          "AccountReference"=>"KenWebShop",    
          "TransactionDesc"=>"Using php HTTP GUZZLE"
      );

        $res = Http::withHeaders($header)->post($stk_push_url, $req_body);
        $response_code = array_key_exists('ResponseCode',$res->json()) ? $res->json()['ResponseCode'] : '1';

        if($response_code === '0'){
            $checkout_request_id = $res->json()['CheckoutRequestID'];
            $this->dispatchBrowserEvent('paymentRequestSent',['checkout_request_id'=>$checkout_request_id]);
            //return true;
        }else{
            if(array_key_exists('errorCode',$res->json())){
                $resultDesc = $res->json()['errorMessage'];
                $this->dispatchBrowserEvent('paymentFailed',['ResultDesc'=>$resultDesc]);
            }
             //dd($res->json());
            return redirect()->back()->with('error','Payment Failed');
        }
        
    }

    public function checkTransactionStatus($checkout_request_id){
        $query_url =  env('MPESA_QUERY_URL');
        $shortcode = env('MPESA_SHORTCODE');
        $passkey = env('MPESA_PASSKEY');
        $timestamp = strftime("%Y%m%d%H%M%S",time());
        $raw_password = $shortcode.$passkey.$timestamp;
        $enc_pwd = base64_encode($raw_password);
        $data = array(
            "BusinessShortCode"=>$shortcode,
            "Password"=>$enc_pwd,
            "Timestamp"=>$timestamp,
            "CheckoutRequestID"=>$checkout_request_id
        );

        $access_token = $this->getAccessToken();

        $header = array('Authorization'=>'Bearer '.$access_token);
        $resp = Http::withHeaders($header)->post($query_url,$data);

        if(!array_key_exists('ResponseCode', $resp->json())){
            $this->dispatchBrowserEvent('paymentRequestSent',['checkout_request_id'=>$checkout_request_id]);
        }else{
            //dd($resp->json());
            $result_code = $resp->json()['ResultCode'];
            if($result_code === '0'){
                $order = Order::findOrFail($this->order_id);
                $order->payment_status = 1;
                $products = $order->fireworks;

                foreach($products as $product){
                    $qty_ordered = $product->pivot->quantity;
                    //$product->stock = $product->stock - $qty_ordered;
                    $product->decrement('stock', $qty_ordered);
                    $product->save();
                }
                if($order->save()){
                    Cart::destroy();
                    $this->emit('cart-updated');
                }
                $this->dispatchBrowserEvent('paymentSuccessful');
                
                $this->sendConfirmationSMS($order);

                return redirect()->route('order_page',['order'=>$order->id]);
                // This is where we invoke the function for creating a new order.
            }else{
                $resultDesc = $resp->json()['ResultDesc'];
                $this->dispatchBrowserEvent('paymentFailed',['ResultDesc'=>$resultDesc]);
                return false;
            }
        }
    }

    public function sendConfirmationSMS(Order $order){
        $phone = $order->phone;
        $order_username = $order->name;
        //$api_url = "https://api.africastalking.com/version1/messaging";
        $app_username = env('AT_API_USERNAME');
        $api_key = env('AT_API_KEY');
        $request_headers = array(
            'Accept'=>'application/json',
            'Content-Type'=>'application/x-www-form-urlencoded',
            'apiKey'=>$api_key);
        $req_data = array(
            'to'=>$order->phone,
            'message'=>"Dear $order_username order number $order->id has been placed successfully. Kindly await as delivery is being processed. Welcome, shop with us!"
        );

        $AT = new AfricasTalking($app_username,$api_key);
        #sms service 
        $sms = $AT->sms();
        $result = $sms->send($req_data);
        return true;
        //dd($result);
    }
}
