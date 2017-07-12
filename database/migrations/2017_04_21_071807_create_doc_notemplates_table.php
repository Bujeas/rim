<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocNotemplatesTable extends Migration
{
    public function up()
    {
        Schema::create('doc_notemplates', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('temp_id')->nullable();
            $table->string('temp_code')->nullable();
            $table->string('temp_name', 100)->nullable();
            $table->string('description', 250)->nullable();
            $table->string('prefix', 20)->nullable();
            $table->string('postfix', 20)->nullable();
            $table->string('division_id', 20)->nullable();
            $table->string('dept_id', 20)->nullable();
            $table->string('section_id', 20)->nullable();
            $table->string('category_id', 20)->nullable();
            $table->string('format', 250)->nullable();
            $table->string('created_by',20)->nullable()->default('SYSTEM');
            $table->string('modified_by',20)->nullable()->default('SYSTEM');
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->unique(['temp_id', 'temp_code']);

            $table->index(['temp_id', 'temp_code', 'temp_name', 'section_id']);
        });
    }

    public function down()
    {
        Schema::drop('doc_notemplates');
    }
}
