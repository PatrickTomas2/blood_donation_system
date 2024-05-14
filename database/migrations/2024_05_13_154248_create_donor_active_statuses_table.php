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
        Schema::create('donor_active_statuses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('donor_id')->unsigned();
            $table->foreign('donor_id')->references('id')->on('donors')->onDelete('cascade')->onDelete('cascade');
            $table->smallInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donor_active_statuses');
    }
};
