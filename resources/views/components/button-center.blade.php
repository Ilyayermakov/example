<button {{ $attributes->class(['btn-add-change'])->merge([
    'type' => 'button',
]) }}>
    {{ $slot }}
</button>
