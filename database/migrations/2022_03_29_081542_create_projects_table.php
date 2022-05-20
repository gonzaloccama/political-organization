<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->mediumText('summary');
            $table->text('description')->nullable();
            $table->bigInteger('responsible');
            $table->string('team')->nullable();
            $table->tinyInteger('priority')->nullable();
            $table->integer('estimated_hours')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->integer('progress')->default(0);
            $table->text('note')->nullable();
            $table->enum('status', ['not-started', 'progress', 'canceled', 'completed'])->default('not-started');
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
        Schema::dropIfExists('projects');
    }
}
