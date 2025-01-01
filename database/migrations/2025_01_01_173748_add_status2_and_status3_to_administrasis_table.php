<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatus2AndStatus3ToAdministrasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('administrasis', function (Blueprint $table) {
            $table->string('status2')->nullable()->after('status');
            $table->string('status3')->nullable()->after('status2');
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
            $table->dropColumn('status2');
            $table->dropColumn('status3');
        });
    }
}
