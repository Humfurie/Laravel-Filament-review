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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Domain\User\Models\User::class);
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->foreignIdFor(\App\Domain\Category\Model\Category::class);
            $table->timestamp('published_date')->nullable();
            $table->string('tags')->nullable();
            $table->string('image');
            $table->string('google_drive_url');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
