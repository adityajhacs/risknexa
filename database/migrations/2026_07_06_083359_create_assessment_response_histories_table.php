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
    Schema::create('assessment_response_histories', function (Blueprint $table) {

        $table->id();

        $table->foreignId('assessment_id')->constrained()->cascadeOnDelete();

        $table->foreignId('question_id')->constrained()->cascadeOnDelete();

        $table->foreignId('user_id')->constrained()->cascadeOnDelete();

        $table->string('type'); // answer_updated, evidence_uploaded, evidence_deleted

        $table->longText('old_answer')->nullable();

        $table->longText('new_answer')->nullable();

        $table->string('old_file')->nullable();

        $table->string('new_file')->nullable();

        $table->timestamps();

    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_response_histories');
    }
};
