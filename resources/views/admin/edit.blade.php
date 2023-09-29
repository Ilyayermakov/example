@extends('layouts.main')

@section('page.title', 'Изменить пост')

@section('main.content')

    <x-title-table>
        <a href="{{ route('admin.posts.show', $post->id) }}">
            {{ __('<-- Назад') }}</a>
        <h2>{{ __('Изменить пост') }}</h2>


    </x-title-table>

    <x-post.form action="{{ route('admin.posts.update', $post->id) }}" method="put" :post="$post">

        <x-button type="submit">
            {{ __('Сохранить') }}
        </x-button>
    </x-post.form>

@endsection
