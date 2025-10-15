@props(['name', 'type' => 'text', 'value' => '', 'required' => false])

<input
    type="{{ $type }}"
    name="{{ $name }}"
    id="{{ $name }}"
    value="{{ old($name, $value) }}"
    {{ $required ? 'required' : '' }}
    {{ $attributes->merge(['style' => 'width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;']) }}
>
@error($name)
    <p style="color: red; font-size: 0.9em; margin-top: 4px;">{{ $message }}</p>
@enderror
