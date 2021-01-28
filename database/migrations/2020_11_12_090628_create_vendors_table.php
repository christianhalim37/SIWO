<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('vendors', function (Blueprint $table) {
            $table->bigIncrements('id_vendor');
            $table->string('nama_vendor');
            $table->string('alamat');
            $table->string('no_telp',12);
            $table->string('deskripsi');
            $table->string('email');
            $table->string('contact_person');
            $table->unsignedBigInteger('kat_vendor_id');
            $table->foreign('kat_vendor_id')->references('id_kat_vendor')->on('kategori_vendor');
            //$table->foreignId('paket_vendor_id')->constrained('paket_vendor');
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
        Schema::dropIfExists('vendors');
    }
}