<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDashboardModelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_dataplatformmodif', function (Blueprint $table) {
            $table->id();
            $table->timestamp('time')->nullable();
            $table->float('humd');
            $table->string('status');
            $table->float('lightsensor');
            $table->float('currentsensor');
            $table->float('voltagesensor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_dataplatformmodif');
    }
}
