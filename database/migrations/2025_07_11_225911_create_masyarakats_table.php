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
        Schema::create('masyarakats', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('pekerjaan')->nullable();
            $table->string('penghasilan')->nullable();
            $table->integer('jumlah_tanggungan')->nullable();
            $table->string('status_rumah')->nullable();
            $table->string('pendidikan')->nullable(); // Tambahan sesuai permintaan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masyarakats');
    }
};
