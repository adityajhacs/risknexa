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
    Schema::table('assessment_responses', function (Blueprint $table) {

        $table->unsignedBigInteger('answer_updated_by')->nullable()->after('updated_by');
        $table->timestamp('answer_updated_at')->nullable();

        $table->unsignedBigInteger('evidence_uploaded_by')->nullable();
        $table->timestamp('evidence_uploaded_at')->nullable();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assessment_responses', function (Blueprint $table) {
            //
        });
    }
};
