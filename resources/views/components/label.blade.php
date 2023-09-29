@props(['required' => false])

<label {{ $attributes->class([
    'mylable',
    $required ? 'required' : ''
    ]) }}>
    {{$slot}}
</label>
