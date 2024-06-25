<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataplatformTable extends Migration
{
    public function up()
    {
        Schema::create('dataplatform', function (Blueprint $table) {
            $table->id();
            $table->timestamp('time');
            $table->json('data');
            $table->string('radio');
            $table->string('type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dataplatform');
    }
}
