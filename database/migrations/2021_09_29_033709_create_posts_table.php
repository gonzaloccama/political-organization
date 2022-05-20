<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigInteger('user_id', false, true);
            $table->enum('user_type', ['user', 'page']);
            $table->enum('in_group', [0, 1])->default(0);
            $table->integer('group_id', false, true)->nullable();
            $table->enum('group_approved', [0, 1])->default(0);
            $table->enum('in_event', [0, 1])->default(0);
            $table->integer('event_id', false, true)->nullable();
            $table->enum('event_approved', [0, 1]);
            $table->string('post_type', 32);
            $table->bigInteger('origin_id', false, true)->nullable();
            $table->string('privacy', 32);
            $table->text('text')->nullable();
            $table->integer('reaction_like_count', false, true)->nullable();
            $table->integer('reaction_love_count', false, true)->nullable();
            $table->integer('reaction_haha_count', false, true)->nullable();
            $table->integer('reaction_yay_count', false, true)->nullable();
            $table->integer('reaction_wow_count', false, true)->nullable();
            $table->integer('reaction_sad_count', false, true)->nullable();
            $table->integer('reaction_angry_count', false, true)->nullable();
            $table->integer('comments', false, true)->nullable();
            $table->integer('shares', false, true)->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('origin_id')->references('id')->on('posts')->onDelete('cascade');
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
