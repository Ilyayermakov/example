@extends('layouts.main')

@section('page.title', 'Blog')

@section('main.content')

    @auth
        @if (auth()->user()->admin === 1)
            <x-title-table>
                <h2>
                    <a href="{{ route('admin.posts.create') }}" class="mynav-link {{ active_link('admin.create') }}"
                        aria-current="page">
                        {{ __('добавить пост') }}
                    </a>
                </h2>
            </x-title-table>
        @endif
    @endauth

    @include('blog.filter')

    @if ($posts->isEmpty())
        {{ __('Нет ни одного поста') }}
    @else
        <x-title-table>
            <div class="mygrid">
                @foreach ($posts as $post)
                    <div class="mygrid-item">
                        <x-post.card :post="$post" />
                    </div>
                @endforeach
            </div>
        </x-title-table>
        <x-title-table>
            <div class="pagin">
                {{ $posts->links() }}
            </div>
        </x-title-table>
    @endif

@endsection
