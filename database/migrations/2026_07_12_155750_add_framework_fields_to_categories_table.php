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
        Schema::table('categories', function (Blueprint $table) {

            $table->foreignId('framework_id')
                ->nullable()
                ->after('id')
                ->constrained('frameworks')
                ->nullOnDelete();

            $table->string('code')->nullable()->after('framework_id');

            $table->integer('display_order')
                ->default(0)
                ->after('description');

            $table->enum('status', ['Active', 'Inactive'])
                ->default('Active')
                ->after('display_order');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {

            $table->dropForeign(['framework_id']);

            $table->dropColumn([
                'framework_id',
                'code',
                'display_order',
                'status'
            ]);

        });
    }
};