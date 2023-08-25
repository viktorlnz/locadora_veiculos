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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 80);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('vehicles', function(Blueprint $table){
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function(Blueprint $table){
            $table->dropForeign('vehicles_category_id_foreign');
            $table->dropColumn('category_id');
        });
        Schema::dropIfExists('categories');
    }
};
