<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {

            // TAMBAH HANYA KOLOM YANG BELUM ADA
            if (!Schema::hasColumn('products', 'battery')) {
                $table->string('battery')->nullable();
            }

            if (!Schema::hasColumn('products', 'stock')) {
                $table->integer('stock')->nullable();
            }

            if (!Schema::hasColumn('products', 'status')) {
                $table->string('status')->nullable();
            }

            // ❌ JANGAN TAMBAH storage LAGI (sudah ada)

        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {

            if (Schema::hasColumn('products', 'battery')) {
                $table->dropColumn('battery');
            }

            if (Schema::hasColumn('products', 'stock')) {
                $table->dropColumn('stock');
            }

            if (Schema::hasColumn('products', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
