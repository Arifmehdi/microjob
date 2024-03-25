<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('categories', 'id')->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->unsignedFloat('min_cost_per_work', 10, 3)->default(0.00);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('status')->default(false);
            $table->boolean('is_deletable')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
