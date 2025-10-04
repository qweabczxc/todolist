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
// database/migrations/2023_01_01_create_user_quest_statistics_table.php
Schema::create('user_quest_statistics', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('group_id')->constrained()->onDelete('cascade');
    $table->integer('total_quests')->default(0);
    $table->integer('completed_quests')->default(0);
    $table->integer('in_progress_quests')->default(0);
    $table->integer('failed_quests')->default(0);
    $table->integer('daily_quests')->default(0);
    $table->integer('goal_quests')->default(0);
    $table->decimal('success_rate', 5, 2)->default(0);
    $table->timestamp('last_activity')->nullable();
    $table->timestamps();
    
    $table->unique(['user_id', 'group_id']);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_quest_statistics');
    }
};
