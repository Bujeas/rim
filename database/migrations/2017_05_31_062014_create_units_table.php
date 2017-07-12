<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('unit_id')->unsigned()->nullable();
            $table->string('unit_code', 20)->nullable();
            $table->string('unit_name', 150)->nullable();
            $table->string('description', 250)->nullable();
            $table->tinyinteger('status')->nullable();
            $table->integer('section_id')->unsigned()->nullable();
            $table->string('created_by',20)->nullable()->default('SYSTEM');
            $table->string('modified_by',20)->nullable()->default('SYSTEM');
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->unique(['unit_id', 'unit_code']);

            $table->index(['section_id', 'unit_code', 'unit_name']);
        });    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('units');
    }
}
