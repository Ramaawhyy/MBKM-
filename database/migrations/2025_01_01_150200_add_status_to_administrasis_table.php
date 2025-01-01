<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToAdministrasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('administrasis', function (Blueprint $table) {
            $table->string('status')->default('waiting')->after('transkrip_nilai');
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
            $table->dropColumn('status');
        });
    }
}
