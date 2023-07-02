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
        Schema::create('news', static function (Blueprint $table): void {
            $table->id();
            $table->string('title', 255);
            $table->string('author', 100)
                ->default('Admin');
            $table->string('image_url', 255)
                ->nullable();
            $table->text('description');
            $table->boolean('is_private')
                ->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
