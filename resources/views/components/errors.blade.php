@if ($errors->any())
<form :action="{{ redirect()->back() }}" method="GET">
    <button class="btn-add" type="submit">
    <div>
        <ul>
            @foreach ($errors->all() as $message)
                <li class="myalert">
                    {{ $message }}
                </li>
            @endforeach
        </ul>
    </div>
</button>
</form>
@endif
