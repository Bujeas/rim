<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocNoHists extends Migration
{
    public function up()
    {
        Schema::create('doc_no_hists', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('document_id', 20)->nullable();
            $table->string('document_name', 50)->nullable();
            $table->string('description', 250)->nullable();
            $table->integer('running_number')->nullable();
            $table->string('template_id', 20)->nullable();
            $table->string('created_by',20)->nullable()->default('SYSTEM');
            $table->string('modified_by',20)->nullable()->default('SYSTEM');
            $table->tinyinteger('status')->nullable();
            $table->string('remarks', 250)->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->index(['document_id', 'document_name']);
        });

    }

    public function down()
    {
         Schema::drop('doc_no_hists');
    }
}
