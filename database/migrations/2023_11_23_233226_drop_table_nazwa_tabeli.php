<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email', 250);
            $table->string('password', 250);
            $table->string('name', 250)->nullable();
            $table->string('surname', 250)->nullable();
            $table->string('pesel', 250)->nullable();
            $table->string('age', 45)->nullable();
            $table->timestamps();


        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
