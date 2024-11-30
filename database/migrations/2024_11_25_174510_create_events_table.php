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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->foreignId('category_id')
                  ->constrained('categories')
                  ->onDelete('cascade');
            $table->datetime('startdatetime');
            $table->datetime('enddatetime');
            $table->integer('ticketsavailable');
            $table->decimal('price', 8, 0);
            $table->enum('location_type', ['online', 'physical']);
            $table->string('link_url')->nullable();
            $table->foreignId('location_id')
                  ->constrained('locations')
                  ->onDelete('cascade');
            $table->text('location_description')->nullable();
            $table->string('img_url')->nullable();

            $table->foreignId('user_id')
            ->constrained('users')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }
    // $table->enum('role', ['admin', 'user', 'eventOrganiser']);

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
