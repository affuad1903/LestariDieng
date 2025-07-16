{{-- 
    Admin Form Input Component
    Usage: @include('admin.components.form-input', [
        'name' => 'field_name',
        'label' => 'Field Label',
        'type' => 'text', // text, email, url, number, password
        'icon' => 'fas fa-icon',
        'placeholder' => 'Enter value...',
        'required' => true,
        'maxlength' => 100,
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
    
    <input type="{{ $type ?? 'text' }}" 
           name="{{ $name }}" 
           id="{{ $name }}" 
           class="admin-form-control @error($name) is-invalid @enderror" 
           value="{{ $value ?? old($name) }}"
           @if(isset($placeholder)) placeholder="{{ $placeholder }}" @endif
           @if(isset($maxlength)) maxlength="{{ $maxlength }}" @endif
           @if(isset($min)) min="{{ $min }}" @endif
           @if(isset($max)) max="{{ $max }}" @endif
           @if(isset($required) && $required) required @endif>
    
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
