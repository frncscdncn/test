<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBascetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bascets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate()->nullable(); // ID пользователя, привязка
            $table->string('laravel_session')->nullable(); // Сессия пользователя
            $table->foreignId('product_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate(); // ID товара, привязка
            $table->integer('count')->unsigned(); // Кол-во товаров в корзине
            $table->boolean('status')->unsigned(); // Статус элемента в корзине
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
        Schema::dropIfExists('bascets');
    }
}
