<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    // Регистрация пользователя
    public function create(UserCreateRequest $req) {

        $user = new User();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = bcrypt($req->password);
        $user->save();

        return 'Регистрация прошла успешно!';
    }

    // Авторизация пользователя
    public function auth(Request $req) {

        if (Auth::attempt($req->only(['email','password']))) {
            return "Авторизация прошла успешно!";
        }

        return "Авторизация не удалась :(";
    }

    // Выход из режима авторизованного пользователя
    public function logout() {

        auth()->guard('web')->logout();
        return "Вы вышли, возвращайтесь ещё! :)";
    }
}
