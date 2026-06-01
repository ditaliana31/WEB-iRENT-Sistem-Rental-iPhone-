<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {

            // HANYA TAMBAH YANG BELUM ADA

            if (!Schema::hasColumn('products', 'ram')) {
                $table->string('ram')->nullable();
            }

            if (!Schema::hasColumn('products', 'processor')) {
                $table->string('processor')->nullable();
            }

            if (!Schema::hasColumn('products', 'camera')) {
                $table->string('camera')->nullable();
            }

            // ❌ storage JANGAN DITAMBAH LAGI (sudah ada)

        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {

            if (Schema::hasColumn('products', 'ram')) {
                $table->dropColumn('ram');
            }

            if (Schema::hasColumn('products', 'processor')) {
                $table->dropColumn('processor');
            }

            if (Schema::hasColumn('products', 'camera')) {
                $table->dropColumn('camera');
            }
        });
    }
};
