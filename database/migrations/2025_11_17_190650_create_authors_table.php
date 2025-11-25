<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('surname_ru', 100);
            $table->string('surname_en', 100);
            $table->string('initials_ru', 150);
            $table->string('initials_en', 150);
            $table->string('orcid', 19);
            $table->string('email', 50)->unique();
            $table->string('job_ru', 255);
            $table->string('job_en', 255);
            $table->string('position_ru', 255);
            $table->string('position_en', 255);
            $table->string('rank_ru', 255);
            $table->string('rank_en', 255);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
