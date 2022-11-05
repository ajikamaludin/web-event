<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->datetime('order_date');
            $table->datetime('order_payment');
            $table->string('order_payment_channel')->default('0'); //0 manual,
            $table->smallInteger('order_status')->default(0); //0 not paid, 1 pending, 2 success, 3 timeout
            $table->string('name');
            $table->string('address', 500);
            $table->string('email');
            $table->string('phone_number');
            $table->smallInteger('is_checked')->default(0); //0 false, 1 true
            $table->text('midtrans_detail_callback')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
