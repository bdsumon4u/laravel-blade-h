<a class="{{ $class() }}" {{ $attributes->merge(compact('href')) }}>
    {{ $slot->isEmpty() ? $label : $slot }}
</a>
