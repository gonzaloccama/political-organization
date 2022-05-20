<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->enum('group_privacy', ['secret', 'closed', 'public']);
            $table->bigInteger('group_admin')->unsigned();
            $table->bigInteger('group_category')->unsigned();
            $table->string('group_name', 64);
            $table->string('group_title')->nullable();
            $table->mediumText('group_description');
            $table->enum('group_publish_enabled', [0, 1]);
            $table->string('group_picture')->nullable();
            $table->bigInteger('group_picture_id')->unsigned()->nullable();
            $table->string('group_cover')->nullable();
            $table->bigInteger('group_cover_id')->unsigned()->nullable();
            $table->string('group_cover_position')->nullable();
            $table->integer('group_album_covers')->nullable();
            $table->integer('group_album_timeline')->nullable();
            $table->integer('group_pinned_post')->nullable();
            $table->bigInteger('group_members')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('group_admin')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
