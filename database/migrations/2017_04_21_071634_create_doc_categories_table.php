<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('doc_categories', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('doc_cat_id')->unsigned()->nullable();
            $table->string('doc_cat', 50)->nullable();
            $table->string('description', 150)->nullable();
            $table->string('created_by',20)->nullable()->default('SYSTEM');
            $table->string('modified_by',20)->nullable()->default('SYSTEM');
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->unique('doc_cat_id');

            $table->index('doc_cat');
        });
    }

    public function down()
    {
        Schema::drop('doc_categories');
    }
}
