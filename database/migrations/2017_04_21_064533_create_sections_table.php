<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTable extends Migration
{
    public function up()
    {
        Schema::create('sections', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('section_id')->unsigned()->nullable();
            $table->string('section_code', 20)->nullable();
            $table->string('section_name', 150)->nullable();
            $table->string('description', 250)->nullable();
            $table->tinyinteger('status')->nullable();
            $table->integer('dept_id')->unsigned()->nullable();
            $table->string('created_by',20)->nullable()->default('SYSTEM');
            $table->string('modified_by',20)->nullable()->default('SYSTEM');
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->unique(['section_id', 'section_code']);

            $table->index(['dept_id', 'section_id', 'section_code', 'section_name']);
            $table->foreign('dept_id')->references('id')->on('departments')->onDelete('cascade');
        });    
    }

    public function down()
    {
        Schema::drop('sections');
    }
}
