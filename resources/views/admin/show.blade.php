@extends('layouts.main')

@section('page.title', $post->title)

@section('main.content')

    <x-title-table>
        <a href="{{ route('blog') }}">
            {{ __('<--К Блогу') }}</a>

        <h2>{{ __('Просмотр поста') }}</h2>

        <a href="{{ route('admin.posts.edit', $post->id) }}">
            {{ __('Изменить-->') }}</a>
    </x-title-table>
    <x-title-table>
        <h3 class="mywhen">
            {{ $post->title }}
        </h3>
        <hr>
        <div class="mycontent">
            {!! $post->content !!}
        </div>
        <hr>
        @if ($post->file && is_string($post->file))
            @php
                $fileArray = json_decode($post->file, true);
            @endphp
            @if (is_array($fileArray))
                <div class="mygallery">
                    @foreach ($fileArray as $filePath)
                        @if (file_exists(public_path('files/' . $filePath)))
                            <img src="{{ asset('files/' . $filePath) }}" class="myslide">
                        @endif
                    @endforeach
                </div>
            @endif
        @endif
        <hr>
    </x-title-table>
    <x-title-table>
        <div class="mywhenColor">
            @if ($post->tags)
                {{ implode(', ', json_decode($post->tags)) }}
            @endif
            <br>
            {{ $post->published_at?->format('d.m.Y') }}
            @auth
                @if (auth()->user()->admin === 1)
                    @if ($post->published)
                    @else
                        {{ __('Не опубликовано') }}
                    @endif
                @endif
            @endauth
            <br />
            {{ $post->published_at?->diffForHumans() }}
        </div>
    </x-title-table>
@endsection
