<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaveParserDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancy_parser', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('indexJobAion');
            $table->text('httpAinua');
            $table->text('vacancy')->nullable();
            $table->text('company')->nullable();
            $table->text('time')->nullable();
            $table->text('vacancyInfoWrapper')->nullable();
            $table->text('companyDescription')->nullable();
            $table->text('category')->nullable();
            $table->text('cityVacancyCity')->nullable();
            $table->timestamp('add_base');
            $table->timestamps();
            /*
            vacancy = 'vacancy-title',
            company = 'company-title',
            time = 'time-passed',
            vacancyInfoWrapper_VacancyBlockPost = 'vacancy-info-wrapper vacancy-block post',
            companyDescription = 'company-description vacancy-block post',
            selectedCategory = 'selected-category',
            selectedCityVacancyCity = 'selected-city vacancy-city'*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_save_parser_data');
    }
}
