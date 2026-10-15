<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_id')->after('id')->nullable()->unique();
        });

        DB::table('users')->orderBy('id')->chunkById(100, function ($users) {
            foreach ($users as $user) {
                $prefix = strtoupper(substr(bin2hex(random_bytes(2)), 0, 4));
                $sequence = str_pad((string) $user->id, 6, '0', STR_PAD_LEFT);
                $profileId = $prefix.'-'.$sequence;

                while (DB::table('users')->where('profile_id', $profileId)->where('id', '!=', $user->id)->exists()) {
                    $prefix = strtoupper(substr(bin2hex(random_bytes(2)), 0, 4));
                    $sequence = str_pad((string) $user->id, 6, '0', STR_PAD_LEFT);
                    $profileId = $prefix.'-'.$sequence;
                }

                DB::table('users')->where('id', $user->id)->update(['profile_id' => $profileId]);
            }
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['profile_id']);
            $table->dropColumn('profile_id');
        });
    }
};
