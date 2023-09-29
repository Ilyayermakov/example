@props(['value' => ''])
<input {{ $attributes->class([
    ])->merge([
        'type' => 'text',
        'value' => (old($attributes->get('name')) ? : $value),
    ]) }}>
