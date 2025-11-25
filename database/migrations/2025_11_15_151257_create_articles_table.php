<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('journal_id')->constrained('journals');
            $table->string('doi', 100);
            $table->string('udk', 20);
            $table->string('edn', 6);
            $table->string('title_ru', 255);
            $table->string('title_en', 255);
            $table->text('annotation_ru');
            $table->text('annotation_en');
            $table->smallInteger('f_page')->unsigned();
            $table->smallInteger('l_page')->unsigned();
            $table->date('date');
            $table->text('references_ru')->nullable();
            $table->text('references_en')->nullable();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
