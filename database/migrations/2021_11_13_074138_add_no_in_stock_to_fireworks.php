<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoInStockToFireworks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fireworks', function (Blueprint $table) {
            // add number of products in stock to the table
            $table->integer('stock')->default(5)->after('height_altitude');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fireworks', function (Blueprint $table) {
            //
            $table->dropColumn('stock');
        });
    }
}
