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
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('relative_path');
            $table->integer('width');
            $table->integer('height');
            $table->string('hash_value');
            // Add other columns or modifications here as needed

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // If you need to rollback, you can define how to reverse the changes here
        $table->dropColumn(['filename','relative_path','width', 'height', 'hash_value']);
    }
};