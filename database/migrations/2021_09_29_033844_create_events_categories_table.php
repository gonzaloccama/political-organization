<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_parent_id', false, true)->nullable();
            $table->string('category_name');
            $table->text('category_description');
            $table->integer('category_order', false, true);
            $table->timestamps();

            $table->foreign('category_parent_id')->references('id')->on('events_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events_categories');
    }
}
