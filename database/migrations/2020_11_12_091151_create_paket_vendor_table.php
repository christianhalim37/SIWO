<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketVendorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('paket_vendor', function (Blueprint $table) {
            $table->bigIncrements('id_paket_vendor');
            $table->integer('harga');
            $table->date('date_booking');
            $table->integer('kapasitas');
            $table->string('day');
            $table->string('package_wedd');
            $table->unsignedBigInteger('vendor_id');
            $table->foreign('vendor_id')->references('id_vendor')->on('vendors');
            //$table->foreignId('id_vendor')->constrained('vendors');
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
        Schema::dropIfExists('paket_vendor');
    }
}