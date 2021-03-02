<label class="{{ $class() }}" {{ $attributes->merge(compact('for')) }} @if($required) title="Required" @endif>{{ $slot->isEmpty() ? $label : $slot }}@if($required)<span>*</span>@endif</label>
