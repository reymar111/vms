<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction_violations', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number');
            $table->integer('academic_year_id');
            $table->integer('student_id');
            $table->integer('violation_id');
            $table->integer('offense_level_id')->nullable();
            $table->integer('penalty_action_id')->nullable();
            $table->integer('status_id')->default(1);
            $table->text('remarks')->nullable();
            $table->text('resolution')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_violations');
    }
};
