<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanMentionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_mentions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->mediumText('abstract');
            $table->text('content');
            $table->integer('population')->nullable();
            $table->integer('region')->nullable();
            $table->integer('province')->nullable();
            $table->integer('town')->nullable();
            $table->string('location')->nullable();
            $table->string('file')->nullable();
            $table->mediumText('files')->nullable();
            $table->enum('type', ['proposal', 'compromise', 'agreement'])->nullable();
            $table->mediumText('representatives')->nullable();
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
        Schema::dropIfExists('plan_mentions');
    }
}
