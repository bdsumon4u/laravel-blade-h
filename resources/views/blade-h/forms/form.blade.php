<form method="{{ $method === 'GET' ? 'GET' : 'POST' }}" class="{{ $class() }}" {{ $attributes->merge(compact('enctype')) }}>
    @unless($method === 'GET')
        @csrf
        @method($method)
    @endunless
    {{ $slot }}
</form>
