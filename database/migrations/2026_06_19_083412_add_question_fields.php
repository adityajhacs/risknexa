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
        Schema::table('questions', function (Blueprint $table) {

    $table->string('control_code')->nullable();
    $table->string('framework_reference')->nullable();
    $table->string('response_type')->nullable();

    $table->boolean('requires_explanation')->default(false);
    $table->boolean('evidence_mandatory')->default(false);

    $table->string('risk_level')->nullable();
    $table->text('control_guidance')->nullable();

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
