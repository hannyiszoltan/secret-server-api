<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secrets', function (Blueprint $table) {
            $table->id();
            $table->string('hash')->unique();
            $table->string('secretText');
            $table->dateTime('createdAt');
            $table->dateTime('expiresAt')->nullable();
            $table->integer('remainingViews');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('secrets');
    }
};
