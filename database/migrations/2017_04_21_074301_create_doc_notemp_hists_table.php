<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocNotempHistsTable extends Migration
{
    public function up()
    {
        Schema::create('doc_notemp_hists', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('temp_id', 20)->nullable();
            $table->string('temp_code', 50)->nullable();
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
            $table->index(['temp_id', 'temp_code', 'temp_name', 'section_id']);
        });
    }

    public function down()
    {
       Schema::drop('doc_notemp_hists');
    }
}
