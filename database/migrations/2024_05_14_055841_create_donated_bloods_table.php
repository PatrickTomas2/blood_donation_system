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
        Schema::create('donated_bloods', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('donor_id')->unsigned();
            $table->foreign('donor_id')->references('id')->on('donors')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('center_id')->unsigned();
            $table->foreign('center_id')->references('id')->on('centers')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('blood_unit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donated_bloods');
    }
};
