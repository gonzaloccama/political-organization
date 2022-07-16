<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->mediumText('technical_team');
            $table->decimal('value')->nullable();
            $table->tinyInteger('priority')->nullable();
            $table->string('viability')->nullable();
            $table->text('observation')->nullable();
            $table->text('evaluation')->nullable();
            $table->string('file')->nullable();
            $table->unsignedBigInteger('plan_mention_id')->nullable();
            $table->timestamps();

            $table->foreign('plan_mention_id')->references('id')->on('plan_mentions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluations');
    }
}
