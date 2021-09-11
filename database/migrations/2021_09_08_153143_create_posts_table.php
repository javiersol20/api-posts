<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Post;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign("category_id")->references("id")->on("categories")->onDelete('cascade');
            $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade');

            $table->string('name');
            $table->string('slug')->unique();

            $table->text('extract');
            $table->longText('body');

            $table->enum('status', [Post::ERASER, Post::PUBLISHED])->default(Post::PUBLISHED);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
