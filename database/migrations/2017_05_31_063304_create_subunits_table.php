<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubunitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subunits', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('subunit_id')->unsigned()->nullable();
            $table->string('subunit_code', 20)->nullable();
            $table->string('subunit_name', 150)->nullable();
            $table->string('description', 250)->nullable();
            $table->tinyinteger('status')->nullable();
            $table->integer('unit_id')->unsigned()->nullable();
            $table->string('created_by',20)->nullable()->default('SYSTEM');
            $table->string('modified_by',20)->nullable()->default('SYSTEM');
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->unique(['subunit_id', 'subunit_code']);

            $table->index(['unit_id', 'subunit_code', 'subunit_name']);
        });  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('subunits');
    }
}
