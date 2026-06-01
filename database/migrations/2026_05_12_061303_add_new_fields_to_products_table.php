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
        Schema::table('products', function (Blueprint $table) {

            // CEK DULU BIAR TIDAK ERROR
            if (!Schema::hasColumn('products', 'storage')) {
                $table->string('storage')->nullable();
            }

            if (!Schema::hasColumn('products', 'battery')) {
                $table->string('battery')->nullable();
            }

            if (!Schema::hasColumn('products', 'stock')) {
                $table->integer('stock')->default(0);
            }

            if (!Schema::hasColumn('products', 'status')) {
                $table->string('status')->default('Available');
            }

            if (!Schema::hasColumn('products', 'image')) {
                $table->string('image')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {

            $columns = [];

            if (Schema::hasColumn('products', 'storage')) {
                $columns[] = 'storage';
            }

            if (Schema::hasColumn('products', 'battery')) {
                $columns[] = 'battery';
            }

            if (Schema::hasColumn('products', 'stock')) {
                $columns[] = 'stock';
            }

            if (Schema::hasColumn('products', 'status')) {
                $columns[] = 'status';
            }

            if (Schema::hasColumn('products', 'image')) {
                $columns[] = 'image';
            }

            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};
