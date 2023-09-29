@extends('layouts.main')

@section('page.title', $post->title)

@section('main.content')

    <x-title-table>

        <a href="{{ route('blog') }}">
            {{ __('<-- Назад') }}
        </a>

        <div class="mywhen">
            {{ $post->title }}
        </div>

        @auth
            @if (auth()->user()->admin === 1)
                <a href="{{ route('admin.posts.edit', $post->id) }}" class="mynav-link {{ active_link('admin.posts.edit') }}"
                    aria-current="page">
                    {{ __('Изменить-->') }}
                </a>
            @endif
        @endauth
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
        <div class="mywhenColor">
            @if ($post->tags)
                {{ implode(', ', json_decode($post->tags)) }}
            @endif
            <br />
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
            <h6><a href="#comments">{{__('Комментарии')}} ({{ $comments->count() }})</a></h6>
            @auth
                @if (auth()->user()->admin === 1)
                    <x-form :action="route('admin.posts.delete', $post)" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <x-button-table class="btn-delete" type="submit"
                            onclick="return confirm('{{ __('Удаляем запись: ') }} {{ $post->title }}')">
                            &#10006;
                        </x-button-table>
                    </x-form>
                @endif
            @endauth
        </div>
    </x-title-table>
    <x-user.index :comments="$comments" :post="$post"></x-user.index>


@endsection
