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
