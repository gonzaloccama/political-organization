<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->mediumText('description');
            $table->integer('executive');

            $table->text('phones');
            $table->text('emails');
            $table->text('addresses');
            $table->text('campus')->nullable();
            $table->text('media_social')->nullable();
            $table->text('facebook_page')->nullable();

            $table->string('logo')->nullable();
            $table->string('logo_white')->nullable();
            $table->string('favicon')->nullable();

            $table->text('mission')->nullable();
            $table->text('vision')->nullable();
            $table->text('objectives')->nullable();
            $table->text('history')->nullable();
            $table->text('values')->nullable();

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
        Schema::dropIfExists('system_settings');
    }
}
