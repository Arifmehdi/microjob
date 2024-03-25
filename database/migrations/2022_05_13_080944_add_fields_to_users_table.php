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
        Schema::table('users', function (Blueprint $table) {
            $table->float('balance', 10, 3)->default(0.00);
            $table->string('image')->nullable();
            $table->tinyInteger('age')->nullable();
            $table->text('about')->nullable();
            $table->boolean('is_admin')->nullable();
            $table->boolean('status')->default(false);
            $table->boolean('is_deletable')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['balance', 'image', 'age', 'about', 'is_admin', 'status']);
        });
    }
};
