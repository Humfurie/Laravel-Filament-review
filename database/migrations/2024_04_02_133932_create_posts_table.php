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
            $table->foreignIdFor(\App\Domain\User\Models\User::class)->constrained();
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->foreignIdFor(\App\Domain\Category\Models\Category::class)->constrained();
            $table->text('content');
            $table->enum('status', ['active', 'inactive']);
            $table->json('tags')->nullable();
            $table->string('image')->nullable();
            $table->timestamp('published_date')->nullable();
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
