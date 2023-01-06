<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('category_id'); // Категория товара, привязка
            $table->foreignId('subcategory_id'); // Подкатегория товара, привязка
            $table->foreignId('subsubcategory_id')->nullable(); // Подподкатегория товара, привязка
            $table->string('title'); // Название товара
            $table->string('slug')->nullable(); // Slug товара
            
            $table->integer('price')->unsigned(); // Цена товара
            $table->integer('width')->unsigned()->nullable(); // Ширина товара
            $table->integer('length')->unsigned()->nullable(); // Высота товара
            $table->integer('weight')->unsigned()->nullable(); // Вес товара
            $table->text('description')->nullable(); // Описание товара
            
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
        Schema::dropIfExists('products');
    }
}
