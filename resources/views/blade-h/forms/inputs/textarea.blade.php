<textarea class="{{ $class() }}" {{ $attributes->merge(compact('name', 'id')) }}>{{ $slot->isEmpty() ? $value : old($key(), $slot) }}</textarea>
