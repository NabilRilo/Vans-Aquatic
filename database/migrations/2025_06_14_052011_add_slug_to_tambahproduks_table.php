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
        Schema::table('tambahproduks', function (Blueprint $table) {
            // Tambahkan kolom slug jika belum ada
            // Pastikan untuk memeriksa apakah kolom sudah ada sebelum menambahkannya
            // untuk menghindari error jika migrasi dijalankan ulang pada tabel yang sudah punya slug.
            if (!Schema::hasColumn('tambahproduks', 'slug')) {
                $table->string('slug')->unique()->after('nama');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tambahproduks', function (Blueprint $table) {
            // Drop kolom slug jika ada
            if (Schema::hasColumn('tambahproduks', 'slug')) {
                $table->dropColumn('slug');
            }
        });
    }
};