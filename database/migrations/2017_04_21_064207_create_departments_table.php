<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    public function up()
    {
        Schema::create('departments', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('dept_id')->nullable();
            $table->string('dept_code', 20)->nullable();
            $table->string('dept_name', 150)->nullable();
            $table->string('description', 150)->nullable();
            $table->tinyinteger('status')->nullable();
            $table->integer('division_id')->unsigned()->nullable();
            $table->string('created_by',20)->nullable()->default('SYSTEM');
            $table->string('modified_by',20)->nullable()->default('SYSTEM');
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->unique(['dept_id', 'dept_code']);

            $table->index(['division_id', 'dept_id', 'dept_code', 'dept_name']);
            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('departments');
    }
}
