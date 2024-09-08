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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('landlord_name');
            $table->string('address');
            $table->string('contact_no');
            $table->string('facebook')->nullable();
            $table->string('email');
            $table->string('apartment_name');
            $table->string('location');
            $table->integer('rooms_available');
            $table->decimal('room_rate', 8, 2);
            $table->string('apartment_image')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'approved'])->default('pending'); // Status for approval
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};
