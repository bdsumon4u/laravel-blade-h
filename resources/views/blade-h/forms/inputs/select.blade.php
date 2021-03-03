<select class="{{ $class() }}" {{ $attributes->merge(compact('name', 'id', 'multiple')) }}>
    @if($slot->isEmpty())
        @foreach($value as $key => $label)
            <option value="{{ $key }}" @if($isSelected($key)) selected @endif @if($isDisabled($key)) disabled @endif>{{ $label }}</option>
        @endforeach
    @else
        {{ $slot }}
    @endif
</select>
