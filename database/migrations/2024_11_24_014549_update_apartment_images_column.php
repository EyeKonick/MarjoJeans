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
        Schema::table('apartments', function (Blueprint $table) {
            // Rename 'apartment_image' to 'apartment_images' and change type to JSON
            $table->dropColumn('apartment_image'); // Remove the existing column
            $table->json('apartment_images')->nullable(); // Add new column to store JSON data
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apartments', function (Blueprint $table) {
            // Reverse changes: Remove 'apartment_images' and restore 'apartment_image'
            $table->dropColumn('apartment_images');
            $table->string('apartment_image')->nullable(); // Re-add the original column
        });
    }
};
