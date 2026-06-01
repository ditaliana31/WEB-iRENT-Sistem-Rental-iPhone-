<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {

            $table->enum('rental_status', [
                'belum_diambil',
                'disewakan',
                'selesai'
            ])->default('belum_diambil');

            $table->integer('rating')->nullable();

            $table->text('review')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {

            $table->dropColumn([
                'rental_status',
                'rating',
                'review'
            ]);
        });
    }
};
