<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabeldatamodifTable extends Migration
{
    public function up()
    {
        Schema::create('tabeldatamodif', function (Blueprint $table) {
            $table->id();
            $table->timestamp('time');
            $table->decimal('temp', 8, 2)->nullable();
            $table->decimal('humd', 8, 2)->nullable();
            $table->boolean('status');
            $table->integer('LightSensor');
            $table->decimal('CurrentSensor', 8, 2);
            $table->decimal('VoltageSensor', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tabeldatamodif');
    }
}
