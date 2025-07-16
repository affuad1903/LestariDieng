{{-- 
    Admin Form Textarea Component
    Usage: @include('admin.components.form-textarea', [
        'name' => 'field_name',
        'label' => 'Field Label',
        'icon' => 'fas fa-icon',
        'required' => true,
        'placeholder' => 'Enter description...',
        'maxlength' => 500,
        'rows' => 4,
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
    
    <textarea name="{{ $name }}" 
              id="{{ $name }}" 
              class="admin-form-textarea @error($name) is-invalid @enderror"
              @if(isset($placeholder)) placeholder="{{ $placeholder }}" @endif
              @if(isset($maxlength)) maxlength="{{ $maxlength }}" @endif
              @if(isset($rows)) rows="{{ $rows }}" @endif
              @if(isset($required) && $required) required @endif>{{ $value ?? old($name) }}</textarea>
    
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
