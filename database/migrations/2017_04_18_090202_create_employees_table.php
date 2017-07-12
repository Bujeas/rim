<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table){
            $table->increments('id');
            $table->timestamps();

            $table->string('name', 100);
            $table->string('email', 100)->unique();
        });
    }

    public function down()
    {
        Schema::drop('employees');
    }
}
