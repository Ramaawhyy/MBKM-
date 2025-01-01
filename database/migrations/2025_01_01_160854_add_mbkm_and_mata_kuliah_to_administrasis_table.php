<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMbkmAndMataKuliahToAdministrasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('administrasis', function (Blueprint $table) {
            $table->string('program_mbkm')->nullable()->after('status');
            for ($i = 1; $i <= 5; $i++) {
                $table->string("mata_kuliah_$i")->nullable()->after('program_mbkm');
            }
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
            $table->dropColumn('program_mbkm');
            for ($i = 1; $i <= 5; $i++) {
                $table->dropColumn("mata_kuliah_$i");
            }
        });
    }
}
