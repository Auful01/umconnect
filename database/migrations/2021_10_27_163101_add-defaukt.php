<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaukt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profil', function (Blueprint $table) {
            $table->string('jenis_kelamin')->default(null);
            $table->string('nim')->default(null);
            $table->date('tgl_lahir')->default(null);
            $table->string('domisili')->default(null);
            $table->string('wa')->default(null);
            $table->string('photo')->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
