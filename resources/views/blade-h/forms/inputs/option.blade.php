<option {{ $attributes->merge(compact('value', 'selected', 'disabled')) }}>{!! $slot->isEmpty() ? $text : $slot !!}</option>
