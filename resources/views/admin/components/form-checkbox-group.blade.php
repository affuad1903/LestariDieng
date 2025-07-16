{{-- 
    Admin Form Checkbox Group Component
    Usage: @include('admin.components.form-checkbox-group', [
        'name' => 'field_name[]',
        'label' => 'Field Label',
        'icon' => 'fas fa-icon',
        'items' => $collection, // Collection or array
        'item_value' => 'id', // Key for value
        'item_label' => 'name', // Key for label
        'selected' => old('field_name', []), // Array of selected values
        'help_text' => 'Optional help text',
        'empty_message' => 'No items available'
    ])
--}}

<div class="admin-form-group">
    <label class="admin-form-label">
        @if(isset($icon))
            <i class="{{ $icon }}"></i>
        @endif
        {{ $label }}
    </label>
    
    @if(isset($help_text))
        <div class="admin-form-help-text mb-3">
            {{ $help_text }}
        </div>
    @endif
    
    <div class="row">
        @forelse ($items as $item)
            <div class="col-md-6 col-12 mb-2">
                <div class="form-check" style="background: #f8fafc; padding: 12px; border-radius: 8px; border: 1px solid #e2e8f0;">
                    <input type="checkbox" 
                           class="form-check-input" 
                           name="{{ $name }}" 
                           value="{{ is_object($item) ? $item->{$item_value} : $item[$item_value] }}" 
                           id="{{ $name }}_{{ is_object($item) ? $item->{$item_value} : $item[$item_value] }}"
                           {{ in_array((is_object($item) ? $item->{$item_value} : $item[$item_value]), $selected ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" 
                           for="{{ $name }}_{{ is_object($item) ? $item->{$item_value} : $item[$item_value] }}" 
                           style="color: #2d3748; font-weight: 500;">
                        {{ is_object($item) ? $item->{$item_label} : $item[$item_label] }}
                    </label>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    {{ $empty_message ?? 'Belum ada data yang tersedia.' }}
                </div>
            </div>
        @endforelse
    </div>
</div>
