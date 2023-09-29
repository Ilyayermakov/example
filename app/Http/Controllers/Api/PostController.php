<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        return 'Страница списков постов';
    }
    public function create(){
        return 'Страница создания поста';
    }
    public function store(){
        return 'Запрос создания поста';
    }
    public function show($id){
        return "Страница просмотра поста {$id}";
    }
    public function edit($id){
        return "Страница изменения поста {$id}";
    }
    public function update(){
        return 'Запрос измения поста';
    }
    public function delete(){
        return 'Запрос удаления поста';
    }
    public function like(){
        return 'Like + 1';
    }
}
