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
        Schema::table('administrasi', function (Blueprint $table) {
            $table->string('nama_penyelenggara')->nullable();
            $table->string('no_hp')->nullable();
            $table->text('deskripsi_kegiatan')->nullable();
            $table->text('capaian_pembelajaran')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('administrasi', function (Blueprint $table) {
            $table->dropColumn(['nama_penyelenggara', 'no_hp', 'deskripsi_kegiatan', 'capaian_pembelajaran']);
        });
    }
};
