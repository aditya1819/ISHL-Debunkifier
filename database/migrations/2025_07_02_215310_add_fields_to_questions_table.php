<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->text('hint')->nullable();
            $table->boolean('answer')->nullable();
            $table->text('disinfo_pattern_card')->nullable();
            $table->text('feedback')->nullable();
            $table->text('pause_and_reflect')->nullable();
        });
    }

    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn(['hint', 'answer', 'disinfo_pattern_card', 'feedback', 'pause_and_reflect']);
        });
    }
};
