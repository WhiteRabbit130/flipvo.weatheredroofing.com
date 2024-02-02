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
        Schema::create('image_metas', function (Blueprint $table) {
            $table->id();
            $table->string('page')->nullable();
            // primary image
            $table->integer('primary')->default(0);
            $table->string('alt')->nullable();
            $table->string('title')->nullable();
            $table->string('caption')->nullable();
            $table->string('description')->nullable();

            $table->string('filename');
            $table->string('path');
            $table->string('url')->nullable();
            $table->morphs('imageable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_metas');
    }
};
