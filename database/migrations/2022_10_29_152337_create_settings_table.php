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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('midtrans_server_key')->nullable();
            $table->string('midtrans_client_key')->nullable();
            $table->string('midtrans_merchant_id')->nullable();
            $table->string('midtrans_snap_prod')->default('https://app.midtrans.com/snap/snap.js');
            $table->string('midtrans_snap_dev')->default('https://app.sandbox.midtrans.com/snap/snap.js');
            $table->string('site_name')->default('Konser Valintina');
            $table->float('ticket_price', 16, 2)->default(10000.00);
            $table->string('term_url')->default('http://google.com');
            $table->smallInteger('is_production')->default(1); //0 dev, 1 prod
            $table->smallInteger('is_open_order')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
