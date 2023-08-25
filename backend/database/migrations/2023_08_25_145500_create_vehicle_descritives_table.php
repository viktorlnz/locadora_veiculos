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
        Schema::create('vehicle_descritives', function (Blueprint $table) {
            $table->id();
            $table->string('color', 100);
            $table->smallInteger('ports', false, true);
            $table->string('transmission', 80);
            $table->timestamps();
        });

        Schema::table('vehicles', function(Blueprint $table) {
            $table->unsignedBigInteger('vehicle_descritive_id')->unique();
            $table->foreign('vehicle_descritive_id')->references('id')->on('vehicle_descritives');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function(Blueprint $table){
            $table->dropForeign('vehicles_vehicle_descritive_id_foreign');
            $table->dropColumn('vehicle_descritive_id');
        });
        Schema::dropIfExists('vehicle_descritives');
    }
};
