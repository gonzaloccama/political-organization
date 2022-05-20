<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_comments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('node_id', false, true)->nullable();
            $table->enum('node_type', ['post', 'photo', 'comment','video','file','shared']);
            $table->bigInteger('user_id', false, true);
            $table->enum('user_type', ['user', 'page'])->default('user');
            $table->text('text');
            $table->string('image')->nullable();
            $table->integer('reaction_like_count',  false, true)->nullable();
            $table->integer('reaction_love_count',  false, true)->nullable();
            $table->integer('reaction_haha_count',  false, true)->nullable();
            $table->integer('reaction_yay_count',  false, true)->nullable();
            $table->integer('reaction_wow_count',  false, true)->nullable();
            $table->integer('reaction_angry_count',  false, true)->nullable();
            $table->integer('replies',  false, true)->nullable();
            $table->timestamps();

            $table->foreign('node_id')->references('id')->on('posts')->onDelete('cascade');
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
        Schema::dropIfExists('posts_comments');
    }
}
