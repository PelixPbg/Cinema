<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('genre');
            $table->string('sutradara');
            $table->year('tahun_rilis');
            $table->integer('durasi'); // dalam menit
            $table->decimal('rating', 3, 1); // misal 8.5
            $table->text('deskripsi');
            $table->string('poster');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};