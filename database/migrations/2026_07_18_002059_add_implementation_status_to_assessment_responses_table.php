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

        $table->string('implementation_status')
              ->nullable()
              ->after('answer');

    });
}


public function down(): void
{
    Schema::table('assessment_responses', function (Blueprint $table) {

        $table->dropColumn('implementation_status');

    });
}
};
