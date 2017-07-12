<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocNumbersTable extends Migration
{
    public function up()
    {
        Schema::create('doc_numbers', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('document_id')->nullable();
            $table->string('document_name', 50)->nullable();
            $table->integer('running_number')->nullable();

            $table->string('description', 250)->nullable();
            $table->string('template_id', 20)->nullable();
            $table->string('created_by',20)->nullable()->default('SYSTEM');
            $table->string('modified_by',20)->nullable()->default('SYSTEM');
            $table->tinyinteger('status')->nullable();
            $table->string('remarks', 250)->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->unique(['document_id', 'document_name']);

            $table->index(['template_id']);
        });
    }

    public function down()
    {
        Schema::drop('doc_numbers');
    }
}
