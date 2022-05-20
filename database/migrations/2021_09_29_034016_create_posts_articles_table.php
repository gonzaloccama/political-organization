<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_articles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('post_id', false, true);
            $table->string('cover')->nullable();
            $table->string('title');
            $table->text('text');
            $table->integer('category_id', false, true);
            $table->mediumText('tags')->nullable();
            $table->integer('views', false, true)->nullable();
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts_articles');
    }
}
