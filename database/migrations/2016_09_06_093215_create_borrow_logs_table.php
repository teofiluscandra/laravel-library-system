<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrow_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor_peminjaman');
            $table->integer('staff_id')->unsigned()->index();
            $table->foreign('staff_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->boolean('is_returned')->default(false);
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali')->nullable();
            $table->string('keterlambatan')->nullable();
            $table->integer('denda')->nullable();
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
        Schema::dropIfExists('borrow_logs');
    }
}
