<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImagesToApartmentsTable extends Migration
{
    public function up()
    {
        Schema::table('apartments', function (Blueprint $table) {
            $table->string('thumbnail_image')->nullable(); // For the thumbnail image
            $table->string('display_image_1')->nullable(); // For the first display image
            $table->string('display_image_2')->nullable(); // For the second display image
        });
    }

    public function down()
    {
        Schema::table('apartments', function (Blueprint $table) {
            $table->dropColumn(['thumbnail_image', 'display_image_1', 'display_image_2']);
        });
    }
}

