<a {{ $attributes->merge(compact('href')) }}>
    {{ $slot->isEmpty() ? $label : $slot }}
</a>
