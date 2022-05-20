<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsPhotoAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_photo_albums', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id', false, true);
            $table->enum('user_type', ['user', 'page'])->default('user');
            $table->enum('in_group', [0, 1])->default(0);
            $table->bigInteger('group_id', false, true)->nullable();
            $table->enum('in_event', [0, 1])->default(0);
            $table->bigInteger('event_id', false, true)->nullable();
            $table->string('title');
            $table->enum('privacy', ['me', 'friends', 'public', 'custom'])->default('public');
            $table->timestamps();

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
        Schema::dropIfExists('posts_photo_albums');
    }
}
