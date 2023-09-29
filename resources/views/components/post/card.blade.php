<x-title-table>
    <x-card>
        <x-card-body>
            <h5 class="mywhen">
                <a class="mylink" href="{{ route('blog.show', $post->id) }}">
                    {{ $post->title }}

            </h5>
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
                <h6>{{__('Комментарии')}} ({{ $post->comments->count() }})</h6>
            </div>
            </a>
        </x-card-body>
    </x-card>
</x-title-table>
