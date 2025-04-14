<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('feed_user_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feed_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['feed_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feed_user_likes');
    }
};
