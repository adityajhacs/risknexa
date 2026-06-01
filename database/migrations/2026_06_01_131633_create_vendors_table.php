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
       Schema::create('vendors', function (Blueprint $table) {
    $table->id();

    $table->string('vendor_name');
    $table->string('website')->nullable();
    $table->string('contact_person');
    $table->string('email')->unique();
    $table->string('phone');
    $table->string('country');

    $table->enum('criticality', [
        'Low',
        'Medium',
        'High',
        'Critical'
    ]);

    $table->enum('status', [
        'Active',
        'Inactive'
    ])->default('Active');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
