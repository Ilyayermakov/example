@extends('layouts.main')

@section('content')

    <x-title-table>
        <div class="myprice">
            <button class="btn-pricelist">{{ __('Price-list:') }}</button>
            <div class="mypricelist">
                <table class="pricetable">
                    <tbody>
                        <tr class="texttable">
                            <th class="textleft">{{ __('Процедура') }}</th>
                            <th class="textright">{{ __('Цена') }}</th>
                        </tr>
                        @foreach ($proceduresAtHome as $row)
                            <tr class="texttable">
                                <td class="textleft">{{ $row->name }}</td>
                                <td class="textright">{{ $row->price }} &#8364;</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @auth
            @if (auth()->user()->admin === 1)
                <x-form action="{{ route('home.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <x-input type="file" name="file[]" multiple />
                    <x-button type="submit">{{ __('Загрузить') }}</x-button>
                </x-form>
            @endif
        @endauth
        <div class="mygallery">
            @foreach ($jobs as $job)
                @if ($job->file && file_exists(public_path('img/job/' . $job->file)))
                    <img src="{{ asset('img/job/' . $job->file) }}" class="myslide">
                @endif
                @auth
                    @if (auth()->user()->admin === 1)
                        <x-form :action="route('home.delete', $job)" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="file_id" value="{{ $job->id }}">
                            <x-button-table class="home_delete" type="submit"
                                onclick="return confirm('ВНИМАНИЕ Удаляем эту фотографию ?')">
                                &#10006;
                            </x-button-table>
                        </x-form>
                    @endif
                @endauth
            @endforeach
        </div>
    </x-title-table>
    <script>
        document.querySelector('.btn-pricelist').addEventListener('click', () => {
            const pricelist = document.querySelector('.mypricelist');
            pricelist.classList.toggle('active');
        });
    </script>
@endsection
