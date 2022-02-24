<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('book_id')->nullable();
            $table->foreign('book_id')->references('id')->on('books');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamp('loan_date')->useCurrent();
            $table->dateTime('scheduled_returned_date');
            $table->dateTime('returned_date')->nullable();
            $table->integer('overdue_days')->nullable();
            $table->string('observations',200);




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
        Schema::dropIfExists('loans');
    }
};
