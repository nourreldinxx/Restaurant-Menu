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
        Schema::table('reservations', function (Blueprint $table) {
            if (!Schema::hasColumn('reservations', 'email')) {
                $table->string('email')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('reservations', 'reservation_code')) {
                $table->string('reservation_code')->unique()->nullable()->after('status');
            }
            if (!Schema::hasColumn('reservations', 'notes')) {
                $table->text('notes')->nullable()->after('reservation_code');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['email', 'reservation_code', 'notes']);
        });
    }
};
