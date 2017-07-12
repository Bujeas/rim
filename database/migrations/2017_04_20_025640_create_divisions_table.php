<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDivisionsTable extends Migration
{
    public function up()
    {
        Schema::create('divisions', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('division_id')->nullable();
            $table->string('division_code', 20)->nullable();
            $table->string('division_name', 150)->nullable();
            $table->string('description', 250)->nullable();
            $table->tinyinteger('status')->nullable();
            $table->string('created_by',20)->nullable()->default('SYSTEM');
            $table->string('modified_by',20)->nullable()->default('SYSTEM');
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->unique(['division_id', 'division_code']);
            
            $table->index(['division_id', 'division_code', 'division_name']);
        });
    }

    public function down()
    {
        Schema::drop('divisions');
    }
}
