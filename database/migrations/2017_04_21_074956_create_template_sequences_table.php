<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateSequencesTable extends Migration
{
    public function up()
    {
        Schema::create('template_sequences', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('sequence_number')->nullable();
            $table->integer('template_id')->unsigned()->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->unique('sequence_number');

            $table->index('template_id');
            $table->foreign('template_id')->references('id')->on('doc_notemplates')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('template_sequences');
    }
}
