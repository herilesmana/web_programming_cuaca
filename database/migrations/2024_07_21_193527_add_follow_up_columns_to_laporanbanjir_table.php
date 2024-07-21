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
        Schema::table('laporanbanjir', function (Blueprint $table) {
            $table->string('deskripsi_follow_up')->nullable();
            $table->foreignId('follow_up_user_id')->nullable();
            $table->timestamp('follow_up_at')->nullable();
            $table->string('follow_up_foto_url')->nullable();

            $table->foreign('follow_up_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporanbanjir', function (Blueprint $table) {
            $table->dropColumn('deskripsi_follow_up');
            $table->dropForeign(['follow_up_user_id']);
            $table->dropColumn('follow_up_user_id');
            $table->dropColumn('follow_up_at');
            $table->dropColumn('follow_up_foto_url');
        });
    }
};
