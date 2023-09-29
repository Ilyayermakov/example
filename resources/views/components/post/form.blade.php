@props(['post' => null])

<x-form {{ $attributes }} enctype="multipart/form-data">
    @csrf
    <x-title-table>
        <x-form-item>
            <x-label required>{{ __('Название поста:') }}</x-label>
            <x-input name="title" value="{{ $post->title ?? '' }}" autofocus />

            <x-error name="title" />

        </x-form-item>
    </x-title-table>

    <x-title-table>
        <x-form-item>
            <x-label required>{{ __('Содержание поста:') }}</x-label>

            <x-trix name="content" value="{{ $post->content ?? '' }}"/>
            <x-input type="file" name="file[]" multiple />
            <x-error name="content" />

        </x-form-item>
    </x-title-table>

    <x-title-table>
        <x-form-item>
            <x-label required>{{ __('Дата публикации:') }}</x-label>

            <x-input name="published_at" value="{{ $post?->published_at?->format('d.m.Y') ?? '' }}"
                placeholder="dd.mm.yyyy" />

            <x-error name="published_at" />

        </x-form-item>
        <x-label>{{ __('Тэги через запятую') }}</x-label>
        <x-input name="tags" value="{{ $post ? ($post->tags ? implode(', ', json_decode($post->tags)) : '') : '' }}"
            placeholder="tag" />

        <x-error name="published_at" />
        <x-form-item>

        </x-form-item>

        <x-form-item>
            <x-checkbox name="published" checked>
                {{ __('Опубликованно') }}
            </x-checkbox>
        </x-form-item>
        {{ $slot }}
    </x-title-table>
</x-form>

<x-title-table>
    <x-form-item>
        <div class="mygallery">
            @isset($post)
                @if ($post->file && is_string($post->file))
                    @php
                        $fileArray = json_decode($post->file, true);
                    @endphp
                    @if (is_array($fileArray))
                        @foreach ($fileArray as $filePathPh)
                            @if (file_exists(public_path('files/' . $filePathPh)))
                                <img src="{{ asset('files/' . $filePathPh) }}" class="myslide">
                            @endif
                            <x-form :action="route('post.photos.delete')" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="post_id_photo" value="{{ $post->id }}">
                                <input type="hidden" name="file_name" value="{{ $filePathPh }}">
                                <x-button-table class="home_delete" type="submit"
                                    onclick="return confirm('{{ __('Удаляем эту фотографию из этой статьи') }})">
                                    &#10006;
                                </x-button-table>
                            </x-form>
                        @endforeach
                    @endif
                @endif
            @endisset
        </div>
    </x-form-item>
</x-title-table>
