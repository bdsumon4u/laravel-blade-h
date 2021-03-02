<textarea class="{{ $class() }}" {{ $attributes->merge(compact('name', 'id')) }}>{{ $slot->isEmpty() ? $value : old($old(), $slot) }}</textarea>
