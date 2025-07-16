{{-- 
    Admin Form Select Component
    Usage: @include('admin.components.form-select', [
        'name' => 'field_name',
        'label' => 'Field Label',
        'icon' => 'fas fa-icon',
        'required' => true,
        'options' => [
            'value1' => 'Label 1',
            'value2' => 'Label 2',
        ],
        'placeholder' => 'Choose option...',
        'help_text' => 'Optional help text',
        'value' => old('field_name', $model->field_name ?? '')
    ])
--}}

<div class="admin-form-group">
    <label for="{{ $name }}" class="admin-form-label">
        @if(isset($icon))
            <i class="{{ $icon }}"></i>
        @endif
        {{ $label }}
        @if(isset($required) && $required)
            <span class="required">*</span>
        @endif
    </label>
    
    <select name="{{ $name }}" 
            id="{{ $name }}" 
            class="admin-form-select @error($name) is-invalid @enderror" 
            @if(isset($required) && $required) required @endif>
        
        @if(isset($placeholder))
            <option value="" disabled {{ (old($name, $value ?? '') == '') ? 'selected' : '' }}>
                {{ $placeholder }}
            </option>
        @endif
        
        @if(isset($options))
            @foreach($options as $option_value => $option_label)
                <option value="{{ $option_value }}" {{ (old($name, $value ?? '') == $option_value) ? 'selected' : '' }}>
                    {{ $option_label }}
                </option>
            @endforeach
        @endif
    </select>
    
    @if(isset($help_text))
        <div class="admin-form-help-text">
            {{ $help_text }}
        </div>
    @endif
    
    @error($name)
        <div class="admin-error-message">
            <i class="fas fa-exclamation-circle"></i>{{ $message }}
        </div>
    @enderror
</div>
