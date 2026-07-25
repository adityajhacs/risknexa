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
        Schema::create('questions', function (Blueprint $table) {

            $table->id();

            // Domain Relationship
            $table->foreignId('domain_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Question Details
            $table->string('control_code')->nullable();

            $table->text('question');

            $table->text('description')->nullable();

            // Response Configuration
            $table->enum('response_type', [
                'Yes/No',
                'Yes/No/NA',
                'Text',
                'Textarea',
                'Number',
                'Date',
                'Dropdown',
                'Multi Select',
                'File Upload'
            ])->default('Yes/No');

            // Validation
            $table->boolean('is_required')->default(true);

            $table->boolean('evidence_required')->default(false);

            // Risk
            $table->integer('risk_weight')->default(1);

            $table->enum('risk_level', [
                'Low',
                'Medium',
                'High',
                'Critical'
            ])->default('Low');

            // Guidance
            $table->text('guidance')->nullable();

            // UI
            $table->integer('display_order')->default(1);

            $table->enum('status', [
                'Active',
                'Inactive'
            ])->default('Active');

            // Audit
            $table->foreignId('created_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};