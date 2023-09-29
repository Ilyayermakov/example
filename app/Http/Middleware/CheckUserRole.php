<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle($request, Closure $next)
    {
        // Проверяем, аутентифицирован ли пользователь
        if (Auth::check()) {
            // Получаем роль пользователя (здесь предполагается, что у пользователя есть поле 'role')
            $userRole = Auth::user()->admin;
            // dd($userRole);
            $currentDateTime = Carbon::now();

            // В зависимости от роли пользователя, добавляем разные условия в запрос
            if ($userRole == 1) {
                // Добавляем условие для админа
                // Например, для админа показываем все посты (не только опубликованные)
                // Здесь вы можете добавить свои собственные условия для админа
            } else {
                // Добавляем условие для обычного пользователя
                // Например, для обычного пользователя показываем только опубликованные посты
                $query = $request->query();
                $query['published'] = true;
                $query['published_at'] = ['<=', $currentDateTime->format('Y-m-d H:i')];
                $request->merge(['query' => $query]);
            }
        }

        return $next($request);
    }
}
