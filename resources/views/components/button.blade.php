<button {{ $attributes->class(['btn-add'])->merge([
    'type' => 'button',
]) }}>
    {{ $slot }}
</button>
