<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatsTable extends Migration
{
    public function up()
    {
        Schema::create('cats', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('dob');
            $table->string('owner_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cats');
    }
}