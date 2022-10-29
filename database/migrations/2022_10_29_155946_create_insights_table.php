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
        Schema::create('insights', function (Blueprint $table) {
            $table->id();
            $table->string('device');
            $table->string('platform');
            $table->string('browser');
            $table->string('languages');
            $table->string('ip');
            $table->string('request');
            $table->string('useragent');
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
        Schema::dropIfExists('insights');
    }
};
