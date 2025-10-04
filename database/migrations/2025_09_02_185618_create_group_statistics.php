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
// database/migrations/2023_01_01_create_group_statistics_table.php
Schema::create('group_statistics', function (Blueprint $table) {
    $table->id();
    $table->foreignId('group_id')->constrained()->onDelete('cascade');
    $table->integer('total_members');
    $table->integer('active_members');
    $table->integer('total_quests');
    $table->integer('completed_quests');
    $table->integer('quests_this_week');
    $table->decimal('average_completion_time', 8, 2);
    $table->decimal('group_success_rate', 5, 2);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_statistics');
    }
};
