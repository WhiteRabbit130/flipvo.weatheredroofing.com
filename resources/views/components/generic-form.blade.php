{{-- resources/views/components/generic-form.blade.php --}}

<form method="{{ $method }}" action="{{ $action }}">

    @csrf
    @method($method ?? 'POST')

    @foreach($fields as $field)
        <div class="form-group">
            <label for="{{ $field['name'] }}">{{ ucfirst($field['label']) }}</label>

            {{-- Determine the type of input --}}
            @if($field['type'] === 'select')
                <select name="{{ $field['name'] }}" id="{{ $field['name'] }}" class="form-control {{ $field['class'] ?? '' }}">
                    @foreach($field['options'] as $option)
                        <option value="{{ $option['value'] }}" {{ old($field['name'], $field['selected'] ?? '') == $option['value'] ? 'selected' : '' }}>
                            {{ $option['label'] }}
                        </option>
                    @endforeach
                </select>
            @elseif($field['type'] === 'textarea')
                <textarea name="{{ $field['name'] }}" id="{{ $field['name'] }}" class="form-control {{ $field['class'] ?? '' }}" placeholder="{{ $field['placeholder'] ?? '' }}">{{ old($field['name'], $field['value'] ?? '') }}</textarea>
            @elseif($field['type'] === 'checkbox')
                <input type="checkbox" name="{{ $field['name'] }}" id="{{ $field['name'] }}" {{ $field['value'] ? 'checked' : '' }} class="{{ $field['class'] ?? '' }}">
            @else
                <input type="{{ $field['type'] ?? 'text' }}" name="{{ $field['name'] }}" id="{{ $field['name'] }}" value="{{ old($field['name'], $field['value'] ?? '') }}" class="form-control {{ $field['class'] ?? '' }}" placeholder="{{ $field['placeholder'] ?? '' }}">
            @endif

            {{-- Error Handling --}}
            @error($field['name'])
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    @endforeach

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
