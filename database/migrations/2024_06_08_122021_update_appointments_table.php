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
        Schema::table('appointments', function (Blueprint $table) {
            // Rename the 'purpose' column to 'notes'
            $table->renameColumn('purpose', 'notes');
            $table->text('notes')->nullable()->change();
            // Add the 'risk_category_id' column
            $table->unsignedBigInteger('risk_category_id')->nullable();

            // Set up the foreign key constraint
            $table->foreign('risk_category_id')->references('id')->on('risk_categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Remove the foreign key constraint
            $table->dropForeign(['risk_category_id']);

            // Drop the 'risk_category_id' column
            $table->dropColumn('risk_category_id');

            // Rename the 'notes' column back to 'purpose'
            $table->renameColumn('notes', 'purpose');
        });
    }
};
