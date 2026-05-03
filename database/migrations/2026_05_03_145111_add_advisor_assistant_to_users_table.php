<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_advisor_assistant')->default(false)->after('is_advisor');
            $table->foreignId('parent_advisor_id')->nullable()->constrained('users')->nullOnDelete()->after('is_advisor_assistant');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['parent_advisor_id']);
            $table->dropColumn(['is_advisor_assistant', 'parent_advisor_id']);
        });
    }
};
