<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;

use App\Order;
use App\Package;

class OrderController extends Controller
{
    public function __construct(){
        $this->middleware(['auth','can:admin'])->only('index');
    }
    //
    public function create(){
        return view('orders.create');
    }

    // take client direct to checkout page
    public function buyNow(Package $package){
        return view('orders.buy-now', ['package'=>$package]);
    }

    public function paymentOrder(Request $request){
        $this->validate($request,[
            'first_name'=>'string|required',
            'second_name'=>'string|required',
            'phone' => ['required','digits:10','starts_with:0','string','regex:/\d{10}$/'],
            'email' => 'email',
            'location' => 'required',
            'delivery_day' => 'required',
        ]);
        
        // check if order is buyNow or normal cart order
        if($request->buyNow){
            dd('Buy Now');
        }
        
        // Normal Cart Order 
        $cart_content = Cart::content();
        if(collect($cart_content)->isEmpty()){
            return redirect()->back()->with('error','Cart is Empty');
        }
        $order_items = array();
        foreach($cart_content as $cart_item){
            array_push($order_items, [$cart_item->id => $cart_item->qty]);
        }
        //dd($order_items);
        $cart_total = Cart::subtotal(2,'.','');
        if($cart_total <= 1000){
            $delivery_fee = 500;
            $amount_to_charge = $cart_total + $delivery_fee;
        }else{
            $delivery_fee = 0;
            $amount_to_charge = $cart_total;
        }

        if(Cookie::has('order_id')){
            $order=Order::findOrFail(cache('order_id'));
        }else{
            $order = new Order;
        }
        
        $user_name = $request->input('first_name').' '.$request->input('second_name');
        $order->name=$user_name;
        $order->location=$request->input('location');
        $order->phone=$request->input('phone');
        $order->user_id='1';
        $order->amount=$cart_total;
        $order->delivery_fee=$delivery_fee;
        $order->delivery= $request->input('delivery_day') === 1 
                            ? date('Y/m/d')
                            : date('Y/m/d',strtotime('tomorrow'));
        // payment_status and delivery_status are set to false by default.
        //dd($order);
        $order->save(); 
        $order_id = $order->id;

        $order_items = [];
        $package_items=[];
        foreach($cart_content as $cart_item){
            if(is_int($cart_item->id)){
                // attach the product to the order
                $order_items[$cart_item->id]=['quantity'=>$cart_item->qty];
            }else{
                // attach the package products to the order
                $package = Package::where('slug',$cart_item->id)->value('id');
                $package_items[$package] = ['quantity'=>$cart_item->qty];
            }
        }
        // sync method accepts an array of IDs to place on the intermediate table. Any IDs that are not in the given array will be removed from the intermediate table.
        
        if(!empty($order_items)){
            $order->fireworks()->sync($order_items);
        }
        if(!empty($package_items)){
            $order->packages()->sync($package_items);
        }
        
        //$order->fireworks()->attach($package_fworks,['quantity'=>$cart_item->qty]);
        Cookie::queue('order_f_name', $request->input('first_name'), 120);
        Cookie::queue('order_s_name', $request->input('second_name'), 120);
        Cookie::queue('order_phone',  $request->input('phone'), 120);
        Cookie::queue('order_email',  $request->input('email'), 120);
        Cookie::queue('order_location', $request->input('location'), 120);
        Cookie::queue('order_id', $order_id, 120);

        

        return view('orders.payment',['form_details'=>$request->input(),'order_id'=>$order_id]);
    }

    public function payNow(Request $request, Package $package){
        $this->validate($request,[
            'first_name'=>'string|required',
            'second_name'=>'string|required',
            'phone' => ['required','digits:10','starts_with:0','string','regex:/\d{10}$/'],
            'email' => 'email',
            'location' => 'required',
            'delivery_day' => 'required',
        ]);

        dd($package);
        // Create a new Order
        $order = new Order;

        $user_name = $request->input('first_name').' '.$request->input('second_name');
        $order->name=$user_name;
        $order->location=$request->input('location');
        $order->phone=$request->input('phone');
        $order->user_id='1';
        $order->amount=$cart_total;
        $order->delivery_fee=$delivery_fee;
        $order->delivery= $request->input('delivery_day') === 1 
                            ? date('Y/m/d')
                            : date('Y/m/d',strtotime('tomorrow'));

        $order->save(); 
        $order_id = $order->id;

        //$package = Package::where('slug',$cart_item->id)->value('id');
        //$package_items[$package] = ['quantity'=>$cart_item->qty];
    }

    public function show(Order $order){

        return view('orders.show',['order'=>$order]);
       
    }

    public function index(){
        $orders = Order::orderByDesc('id')->paginate(10);
        return view('orders.index',['orders'=>$orders]);
    }

    public function complete(Request $request, Order $order){
        /* Confirm when the product has been delivered to the customer */
        if($request->input('delivery_status')!=='on'){
            return redirect()->back()->with('error',"Delivery $order->id not complete");
        }
        $order->delivery_status=1;
        $order->save();

        return redirect()->back()->with('success','Order Marked as complete');
    }
}
