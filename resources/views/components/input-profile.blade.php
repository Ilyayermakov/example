@props(['value' => ''])
<input {{ $attributes->class([
    'input-update-profile'
        ])->merge([
        'type' => 'text',
        
        'value' => (old($attributes->get('name')) ? : $value),
    ]) }}>
