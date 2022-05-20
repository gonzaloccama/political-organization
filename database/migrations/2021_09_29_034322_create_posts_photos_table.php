<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_photos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('post_id', false, true);
            $table->bigInteger('album_id', false, true);
            $table->string('source');
            $table->enum('blur', [0, 1])->default(0);
            $table->integer('reaction_like_count', false, true)->nullable();
            $table->integer('reaction_love_count', false, true)->nullable();
            $table->integer('reaction_haha_count', false, true)->nullable();
            $table->integer('reaction_yay_count', false, true)->nullable();
            $table->integer('reaction_wow_count', false, true)->nullable();
            $table->integer('reaction_sad_count', false, true)->nullable();
            $table->integer('reaction_angry_count', false, true)->nullable();
            $table->integer('comments', false, true)->nullable();
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
        Schema::dropIfExists('posts_photos');
    }
}
