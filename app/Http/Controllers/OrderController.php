<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* Используем модели */
use App\Models\User;
use App\Models\Bascet;
use App\Models\Order;

class OrderController extends Controller
{
    // Формирование нового заказа
    public function create(Request $req) {
        
        $user = User::find(auth()->id());
        $laravel_session = $req->cookie('laravel_session');

        if ($user) { // Если пользователь авторизован
            $bascets = Bascet::where('user_id', $user->id)->where('status', 1)->get();
        } else { // Если нет
            $bascets = Bascet::where('laravel_session', $laravel_session)->where('status', 1)->get();
        }
        
        $bascetsID = []; // Тут будет список ID элементов корзины
        $sum = 0; // Тут будет общая сумма заказа

        foreach ($bascets as $bascet) { // Пробегаемся по всем элементам корзины конкретного пользователя
            // Высчитываем общую сумму заказа
            $sum += $bascet->product->price * $bascet->count;

            array_push($bascetsID, $bascet->id); // Добавляем ID элемента корзины в массив
            Bascet::find($bascet->id)->update(['status' => 2]); // Меняем статус элемента корзины с "1" на "2", что значит находится в Заявке
        }
        
        $order = new Order;
        
        if ($user) { // Если пользователь авторизован
            $order->user_id = $user->id;
            $order->email = $user->email;
            $order->phone_number = $user->phone_number;
        } else { // Если нет
            $order->laravel_session = $laravel_session;
            $order->email = $req->email;
            $order->phone_number = $req->phone_number;
        }

        $order->bascetsID = serialize($bascetsID);
        $order->status = 1;
        $order->sum = $sum;
        $order->save();

        return "Поздравляем, Ваша заявка оформлена!";
    }
    

    // Получение всех своих заявок для авторизованного пользователя
    public function myOrders(Request $req) {
        $orders = Order::where('user_id', auth()->id())->get();
        return json_encode($orders);
    }
}
