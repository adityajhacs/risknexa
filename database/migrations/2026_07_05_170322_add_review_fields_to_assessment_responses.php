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

        $table->text('review_comment')->nullable();

        $table->string('review_status')
              ->default('Pending');

    });
}

public function down(): void
{
    Schema::table('assessment_responses', function (Blueprint $table) {

        $table->dropColumn([
            'review_comment',
            'review_status'
        ]);

    });
}
};
