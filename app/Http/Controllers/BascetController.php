<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Bascet;

class BascetController extends Controller
{
    // Добавление товара в корзину
    public function create(Request $req) {

        $product = Product::find($req->product_id);
        $user = User::find(auth()->id());
        $laravel_session = $req->cookie('laravel_session');

        if ($product) {

            if ($user) { // Если авторизован
                $bascet = Bascet::where('product_id', $req->product_id)
                    ->where('user_id', auth()->id())
                    ->where('status', 1)->first();
            } else { // Если нет
                $bascet = Bascet::where('product_id', $req->product_id)
                    ->where('laravel_session', $laravel_session)
                    ->where('status', 1)->first();
            }

            if ($bascet) { // Проверяем, имеется ли данная позиция уже в корзине
                
                // При условии, что данный товар уже в корзине, добавляем дополнительное кол-во
                Bascet::find($bascet->id)->update(['count' => $bascet->count + $req->count]);

                return "Изменения по товару в корзине сохранены";
            } else {

                // Добавляем товар в корзину
                $bascet = new Bascet;
                $user ? $bascet->user_id = $product->auth()->id() : $bascet->laravel_session = $laravel_session;
                $bascet->product_id = $req->product_id;
                $bascet->count = $req->count;
                $bascet->status = 1;
                $bascet->save();

                return "Товар добавлен в корзину";
            }
        }

        return false;
    }

    // Редактирование кол-ва позиции в корзине, из самой корзины
    public function edit(Request $req, $bascet_id) {

        $user = User::find(auth()->id());
        $laravel_session = $req->cookie('laravel_session');

        if ($user) { // Если авторизован
            $bascet = Bascet::where('id', $bascet_id)
                ->where('user_id', auth()->id())
                ->where('status', 1)->first();
        } else { // Если нет
            $bascet = Bascet::where('id', $bascet_id)
                ->where('laravel_session', $laravel_session)
                ->where('status', 1)->first();
        }

        if ($bascet) {
            
            Bascet::find($bascet->id)->update(['count' => $req->count]);
            return "Редактирование кол-ва товара в корзине прошло успешно!";
        }

    }
    
    // Удаляем позицию из корзины, меняя её статус с "1" (активно), на "0" (удален)
    public function delete(Request $req, $bascet_id) {

        $user = User::find(auth()->id());
        $laravel_session = $req->cookie('laravel_session');

        if ($user) { // Если авторизован
            $bascet = Bascet::where('id', $bascet_id)
                ->where('user_id', auth()->id())
                ->where('status', 1)->first();
        } else { // Если нет
            $bascet = Bascet::where('id', $bascet_id)
                ->where('laravel_session', $laravel_session)
                ->where('status', 1)->first();
        }

        if ($bascet) {
            
            // Меняем статус позиции с "1" (активно), на "0" (удален)
            Bascet::find($bascet_id)->update(['status' => 0]);

            return "Позиция удалена из корзины";
        }

    }
}
