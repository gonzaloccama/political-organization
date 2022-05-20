<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsCommentsReactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_comments_reactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('comment_id', false, true);
            $table->bigInteger('user_id', false, true);
            $table->string('reaction', 32);
            $table->timestamps();

            $table->foreign('comment_id')->references('id')->on('posts_comments')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts_comments_reactions');
    }
}
