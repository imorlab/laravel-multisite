<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('people', function (Blueprint $table) {
            if (!Schema::hasColumn('people', 'active')) {
                $table->boolean('active')->default(true)->after('slug');
            }
            if (!Schema::hasColumn('people', 'order')) {
                $table->integer('order')->default(0)->after('active');
            }
            if (!Schema::hasColumn('people', 'type')) {
                $table->string('type')->default('staff')->after('order');
            }
        });
    }

    public function down(): void
    {
        Schema::table('people', function (Blueprint $table) {
            $table->dropColumn(['active', 'order', 'type']);
        });
    }
};
