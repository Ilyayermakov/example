@php($id = Str::uuid())

<div class="form-check">
    <input type="checkbox" {{ $attributes->merge([
        'value' => 1,
        'checked' => !! old($attributes->get('name')),
    ]) }} class="mycheck"
        id="{{$id}}">
    <label class="mycheck" for="{{$id}}">
        {{ $slot }}
    </label>
</div>
