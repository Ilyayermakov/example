@props(['value' => ''])
<input {{ $attributes->class([
    'input-add',
    ])->merge([
        'type' => 'text',
        'value' => (old($attributes->get('name')) ? : $value),
    ]) }}>
