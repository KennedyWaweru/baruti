<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMpesaResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpesa_responses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->json('responseData');
            $table->integer('result_code');
            $table->string('result_description');
            $table->string('merchant_request_id');
            $table->string('checkout_request_id');
            $table->integer('phone_number')->nullable();
            $table->integer('transaction_amount')->nullable(); 
            $table->string('mpesa_receipt_number')->nullable();
            $table->string('balance')->nullable();
            $table->string('transaction_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mpesa_responses');
    }
}
