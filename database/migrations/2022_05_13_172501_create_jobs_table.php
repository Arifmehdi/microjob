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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id()->startingValue(500);
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            // $table->tinyText('title');
            // $table->tinyText('slug')->unique();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('proof_details')->nullable();
            $table->string('image')->nullable();
            $table->bigInteger('num_of_worker')->nullable();
            $table->unsignedFloat('per_worker_amount', 10, 3)->nullable();
            $table->integer('num_of_screenshot')->nullable();
            $table->integer('estimated_day')->nullable();
            $table->unsignedFloat('estimated_cost', 10, 3)->nullable();
            $table->boolean('status')->default(false);
            $table->boolean('is_approved')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
};
