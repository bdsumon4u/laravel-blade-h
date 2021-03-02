@error($key(), $bag)
<small class="{{ $class() }}" {{ $attributes }}>{{ $slot->isEmpty() ? $message : $slot }}</small>
@enderror
