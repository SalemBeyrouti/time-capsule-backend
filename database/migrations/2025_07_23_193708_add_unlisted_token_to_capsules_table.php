<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::table('capsules', function (Blueprint $table) {
            $table->string('unlisted_token')->nullable()->unique()->after('visibility');
        });
    }

   
    public function down(): void
    {
        Schema::table('capsules', function (Blueprint $table) {
            $table->dropColumn('unlisted_token');
        });
    }
};
