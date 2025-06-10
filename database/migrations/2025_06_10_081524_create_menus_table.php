<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('menu_text');
            $table->string('menu_icon')->nullable();
            $table->string('menu_url')->nullable();
            $table->integer('menu_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('menus');
    }
};

