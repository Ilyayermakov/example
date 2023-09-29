@props(['comments', 'post'])

<x-title-table>
    <section class="comments" id="comments">
        <div>
            @foreach ($comments as $comment)
                <div class="title_comment">
                    @auth
                        @if (auth()->user()->admin === 1)
                            <x-form :action="route('comment.delete', $comment)" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                <x-button-table class="home_delete" type="submit"
                                    onclick="return confirm('{{ __('Удаляем комментарий:') }} {{ $comment->content }} ?')">
                                    &#10006;
                                </x-button-table>
                            </x-form>
                        @endif
                    @endauth
                    @if ($comment->user_avatar && file_exists(public_path('img/avatars/' . $comment->user_avatar)))
                        <img src="{{ asset('/img/avatars/' . $comment->user_avatar) }}" width="50" height="50">
                    @endif
                    {{ $comment->created_at->format('d.m.Y H:i') }}
                    {{ $comment->user_name }}
                </div>
                <div class="content_comment">
                    {!! $comment->content !!}
                    <hr>
                </div>
                @php
                    $fileArray = json_decode($comment->file, true);
                @endphp
                @if (is_array($fileArray))
                    <div class="mygalleryComment">
                        @foreach ($fileArray as $filePath)
                            @if (file_exists(public_path('files/' . $filePath)))
                                <img src="{{ asset('files/' . $filePath) }}" class="myslideComment">
                            @endif
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>
        <button class="btn-comment wrightcomment">{{ __('Написать комментарий') }}</button>
        <div class="wrighttrix">
            <x-form action="{{ route('blog.create.comment', ['post_id' => $post->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <x-trix name="content" />
                <x-input type="file" name="file[]" multiple />
                <x-error name="content" />
                <x-button class="btn-comment" type="submit">{{ __('Сохранить') }}</x-button>
            </x-form>
        </div>
    </section>
</x-title-table>
<script>
    document.querySelector('.wrightcomment').addEventListener('click', () => {
        const pricelist = document.querySelector('.wrighttrix');
        pricelist.classList.toggle('active');
    });
</script>
