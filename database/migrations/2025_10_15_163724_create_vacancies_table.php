<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->comment('название вакансии');
            $table->text('work_schedule')->comment('грфик и место работы');
            $table->string('salary', 50)->comment('зарплата');
            $table->tinyInteger('numberOfSpecialist')->comment('кол-во специалистов');;
            $table->string('gender', 15)->comment('пол');;
            $table->string('experience', 100)->comment('опыт работы');;
            $table->text('responsibilities')->comment('обязанности');;
            $table->text('conditions')->comment('условия');;
            $table->text('addInformation')->comment('доп информация');;
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
