<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('users', function (Blueprint $table) {

        if (!Schema::hasColumn('users', 'role')) {
            $table->string('role')
                ->default('company_admin')
                ->after('password');
        }

        if (!Schema::hasColumn('users', 'vendor_id')) {
            $table->foreignId('vendor_id')
                ->nullable()
                ->after('role')
                ->constrained('vendors')
                ->nullOnDelete();
        }
    });
}

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropForeign(['vendor_id']);
            $table->dropColumn(['role', 'vendor_id']);

        });
    }
};