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
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('soundcloud')->nullable();
            $table->string('spotify')->nullable();
            $table->string('bandcamp')->nullable();
            $table->string('mixcloud')->nullable();
            $table->string('github')->nullable();

            $table->string('cashapp')->nullable();
            $table->string('venmo')->nullable();
            $table->string('paypal')->nullable();

            $table->string('ebay')->nullable();
            $table->string('amazon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_infos');
    }
};
