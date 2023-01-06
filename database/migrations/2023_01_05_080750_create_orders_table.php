<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate()->nullable(); // ID авторизованного пользователя
            $table->string('laravel_session')->nullable(); // Сессия неавторизованного пользователя
            $table->text('bascetsID'); // Список ID элементов корзины
            $table->string('email'); // Эл. почта клиента
            $table->string('phone_number'); // Номер телефона клиента
            $table->integer('sum')->unsigned(); // Общая сумма заявки
            $table->boolean('status')->unsigned(); // Статус заяки
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
        Schema::dropIfExists('orders');
    }
}
