<select class="{{ $class() }}" {{ $attributes->merge(compact('name', 'id', 'multiple')) }}>
    @if($slot->isEmpty())
        @foreach(SelectH::data() as $value => $text)
            <H:option :value="$value" :text="$text" />
        @endforeach
    @else
        {{ $slot }}
    @endif
</select>
