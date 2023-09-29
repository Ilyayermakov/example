@extends('layouts.auth-admin')

@section('page.title', 'Админка')
<x-title-table>
    <x-button class="comments"><h2>{{ __('All Comments') }}</h2></x-button>
</x-title-table>
<div class="comment">
<x-table-only>
    <thead class="admin-color">
        <tr>
            <th>{{ __('Post') }}</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Comment') }}</th>
            <th>{{ __('Created') }}</th>
        </tr>
    </thead>
    <tbody class="admin-color">
        @foreach ($comments as $comment)
            <tr>
                <td data-label="{{ __('Post') }}:"><a
                        href="{{ route('blog.show', $comment->post_id) }}">{{ $comment->post_title }}</a></td>
                <td data-label="{{ __('Name') }}:"><a
                    href="{{ route('blog.show', $comment->post_id) }}">{{ $comment->user_name }}</a></td>
                <td data-label="{{ __('Comment') }}:"><a
                    href="{{ route('blog.show', $comment->post_id) }}">{!! $comment->content !!}</a></td>
                <td data-label="{{ __('Created') }}:"><a
                    href="{{ route('blog.show', $comment->post_id) }}">{{ $comment->formatted_created_at }}</a></td>
            </tr>
        @endforeach
    </tbody>
</x-table-only>
</div>
<x-title-table>
    <h2>{{ __('All Users') }}</h2>
</x-title-table>
<x-table-only>
    <thead class="admin-color">
        <tr>
            <th>{{ __('id') }}</th>
            <th>{{ __('created_at') }}</th>
            <th>{{ __('updated_at') }}</th>
            <th>{{ __('name') }}</th>
            <th>{{ __('email') }}</th>
            <th>{{ __('Avatar') }}</th>
            <th>{{ __('Active') }}</th>
            <th>{{ __('Admin') }}</th>
        </tr>
    </thead>
    <tbody class="admin-color">
        @foreach ($users as $user)
            <tr>
                <x-form action="{{ route('change.admin.updateUser', $user->id) }}" method="POST">
                    @csrf
                    <td data-label="{{ __('id') }}:">{{ $user->id }}</td>
                    <td data-label="{{ __('created_at') }}:">{{ $user->created_at }}</td>
                    <td data-label="{{ __('updated_at') }}:">{{ $user->updated_at }}</td>
                    <td data-label="{{ __('name') }}:">{{ $user->name }}</td>
                    <td data-label="{{ __('email') }}:">{{ $user->email }}</td>
                    <td data-label="{{ __('avatar') }}:">{{ $user->avatar }}</td>
                    <td data-label="{{ __('active') }}:">
                        <x-input class="input-update" name="active" type="text" value="{{ $user->active }}" />
                    </td>
                    <td data-label="{{ __('admin') }}:">
                        <x-input class="input-update" name="admin" type="text" value="{{ $user->admin }}" />
                    </td>
                    <td>
                        <x-button-table type="submit" class="btn-add">{{ __('Сохранить') }}</x-button-table>
                    </td>
                </x-form>
            </tr>
        @endforeach
    </tbody>
</x-table-only>
<x-title-table>
    <h2>{{ __('Activity') }}
        <x-form action="{{ route('delete.all') }}" method="POST">
            @csrf
            @method('DELETE')
            <x-button-table class="btn-add" type="submit"
                onclick="return confirm('{{__('ВНИМАНИЕ Удаляем ВСЕ записи?')}}')">{{ __('Удалить все данные') }}</x-button-table>
        </x-form>
    </h2>
</x-title-table>
<x-table-only>
    <tbody class="admin-color">
        @foreach ($activities as $activity)
            <tr>
                <td data-label="{{ __('Удалить клиента') }}:">
                    <x-form :action="route('change.admin.deleteActivity', $activity)" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="userAct" value="{{ $activity->id }}">
                        <x-button-table class="btn-delete" type="submit"
                            onclick="return confirm('{{__('ВНИМАНИЕ Удаляем запись:')}}')">
                            &#10006;
                        </x-button-table>
                    </x-form>
                </td>
                <td data-label="{{ __('id') }}:">{{ $activity->user_id }}</td>
                <td data-label="{{ __('created_at') }}:">{{ $activity->created_at }}</td>
                <td data-label="{{ __('name') }}:">{{ $activity->name }}</td>
                <td data-label="{{ __('activity') }}:">{{ $activity->activity }}</td>
            </tr>
            <p></p>
        @endforeach
    </tbody>
</x-table-only>
<script>
    document.querySelector('.comments').addEventListener('click', () => {
        const pricelist = document.querySelector('.comment');
        pricelist.classList.toggle('active');
    });
</script>
