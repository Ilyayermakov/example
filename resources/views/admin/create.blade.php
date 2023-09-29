@extends('layouts.main')

@section('page.title', 'Создать пост')

@section('main.content')

    <x-title-table>
        <a href="{{ route('blog') }}">
            {{ __('<-- Назад') }}
        </a>
       <h2>{{ __('Создать пост') }}</h2>
    </x-title-table>

    <x-post.form action="{{ route('admin.posts.store') }}" method="post">
        <x-button type="submit">
            <h4>
                {{ __('Создать пост') }}
            </h4>
        </x-button>

    </x-post.form>

@endsection
