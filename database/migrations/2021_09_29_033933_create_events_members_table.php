<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_members', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('event_id', false, true);
            $table->bigInteger('user_id', false, true);
            $table->enum('is_invited', [0, 1]);
            $table->enum('is_interested', [0, 1]);
            $table->enum('is_going', [0, 1]);
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
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
        Schema::dropIfExists('events_members');
    }
}
