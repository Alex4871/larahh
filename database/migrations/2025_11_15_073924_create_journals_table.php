<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->string('title_ru', 255);
            $table->string('title_en', 255);
            $table->string('issn', 9);
            $table->string('eissn', 9)->nullable();
            $table->smallInteger('volume')->unsigned();
            $table->smallInteger('issue')->unsigned();
            $table->date('date');
            $table->string('publisher', 255);
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('journals');
    }
};
