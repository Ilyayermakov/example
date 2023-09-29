@props(['value' => ''])
<textarea {{ $attributes
->merge([
    'class' => 'input-add'
    ])
    }}>{{ old($attributes->get('name')) ?? $value }}
    </textarea>
