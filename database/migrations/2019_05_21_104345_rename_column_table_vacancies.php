<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnTableVacancies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::table('vacancies', function($table) {
            $table->renameColumn('indexJobAion', 'indexjob');
            $table->renameColumn('httpAinua', 'httpjob');
        });//
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vacancies', function($table) {
            $table->renameColumn('indexjob','indexJobAion');
            $table->renameColumn('httpjob','httpAinua');
        });////
    }
}
