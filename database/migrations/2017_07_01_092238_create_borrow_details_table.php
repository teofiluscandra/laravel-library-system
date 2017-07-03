<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrow_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('borrow_id')->unsigned()->index();
            $table->foreign('borrow_id')->references('id')->on('borrow_logs')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('book_id')->unsigned()->index();
            $table->foreign('book_id')->references('id')->on('books')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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

        Schema::dropIfExists('borrow_details');
    }
}
