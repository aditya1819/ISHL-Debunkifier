<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable(); // Store image path/filename
            $table->json('possible_reasons'); // Store array of possible reasons
            $table->integer('section_count');
            $table->json('section_data'); // Store array of section data
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('questions');
    }
};