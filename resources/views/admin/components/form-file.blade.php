{{-- 
    Admin Form File Upload Component
    Usage: @include('admin.components.form-file', [
        'name' => 'field_name',
        'label' => 'Field Label',
        'icon' => 'fas fa-icon',
        'required' => true,
        'accept' => 'image/*',
        'max_size' => 5,
        'allowed_types' => 'image/jpeg,image/png',
        'upload_text' => 'Klik atau drag & drop file di sini',
        'help_text' => 'Format: JPG, PNG (Max: 5MB)'
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
    
    <div class="admin-file-upload-container">
        <input type="file" 
               name="{{ $name }}" 
               id="{{ $name }}" 
               class="admin-file-upload-input @error($name) is-invalid @enderror"
               @if(isset($accept)) accept="{{ $accept }}" @endif
               @if(isset($max_size)) data-max-size="{{ $max_size }}" @endif
               @if(isset($allowed_types)) data-allowed-types="{{ $allowed_types }}" @endif
               @if(isset($required) && $required) required @endif>
        
        <div class="admin-file-upload-icon">
            @if(isset($upload_icon))
                <i class="{{ $upload_icon }}"></i>
            @else
                <i class="fas fa-cloud-upload-alt"></i>
            @endif
        </div>
        
        <div class="admin-file-upload-label">
            {{ $upload_text ?? 'Klik atau drag & drop file di sini' }}
            @if(isset($help_text))
                <br><small class="text-muted">{{ $help_text }}</small>
            @endif
        </div>
    </div>
    
    @error($name)
        <div class="admin-error-message">
            <i class="fas fa-exclamation-circle"></i>{{ $message }}
        </div>
    @enderror
</div>
