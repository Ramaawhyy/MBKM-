<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNamaWaliDosenAndNotesToAdministrasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('administrasis', function (Blueprint $table) {
            $table->string('nama_wali_dosen')->nullable()->after('dosen_wali');
            $table->text('note1')->nullable()->after('status3');
            $table->text('note2')->nullable()->after('note1');
            $table->text('note3')->nullable()->after('note2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('administrasis', function (Blueprint $table) {
            $table->dropColumn('nama_wali_dosen');
            $table->dropColumn('note1');
            $table->dropColumn('note2');
            $table->dropColumn('note3');
        });
    }
}
