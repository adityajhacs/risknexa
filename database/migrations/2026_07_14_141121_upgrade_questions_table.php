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

        $table->text('description')
              ->nullable()
              ->after('question');

        $table->integer('display_order')
              ->default(1)
              ->after('control_guidance');

    });
}
public function down(): void
{
    Schema::table('questions', function (Blueprint $table) {

        $table->dropColumn([
            'description',
            'display_order'
        ]);

    });
}
};
