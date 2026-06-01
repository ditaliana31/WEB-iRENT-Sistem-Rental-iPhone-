<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {

            // TAMBAH kolom kalau belum ada
            if (!Schema::hasColumn('products', 'storage')) {
                $table->string('storage')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {

            // HAPUS kolom saat rollback (kalau ada)
            if (Schema::hasColumn('products', 'storage')) {
                $table->dropColumn('storage');
            }
        });
    }
};
