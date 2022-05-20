<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashContributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_contributions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('contributor_id', false, true);
            $table->decimal('amount');
            $table->enum('type_file', ['document', 'image']);
            $table->string('attachment_file')->nullable();
            $table->mediumText('note')->nullable();
            $table->timestamps();

            $table->foreign('contributor_id')->references('id')->on('contributors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_contributions');
    }
}
