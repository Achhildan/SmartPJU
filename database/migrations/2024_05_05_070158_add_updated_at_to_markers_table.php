<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('markers', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('markers', function (Blueprint $table) {
            //
        });
        Schema::table('markers', function (Blueprint $table) {
            $table->timestamp('updated_at')->nullable();
        });
        
    }
};
