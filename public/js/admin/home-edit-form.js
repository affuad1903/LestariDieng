/**
 * Home Edit Form JavaScript
 * Enhanced form interactions and file upload handling
 */

document.addEventListener('DOMContentLoaded', function() {
    initializeFileUploads();
    initializeFormValidation();
    initializeInputEffects();
});

/**
 * Initialize file upload interactions
 */
function initializeFileUploads() {
    const fileInputs = document.querySelectorAll('.file-upload-input');
    
    fileInputs.forEach(input => {
        const container = input.closest('.file-upload-container');
        const label = container.querySelector('.file-upload-label');
        const originalText = label.innerHTML;
        
        // Drag and drop handlers
        container.addEventListener('dragover', handleDragOver);
        container.addEventListener('dragleave', handleDragLeave);
        container.addEventListener('drop', (e) => handleDrop(e, input, label));
        
        // File input change handler
        input.addEventListener('change', (e) => handleFileChange(e, label, originalText));
    });
}

/**
 * Handle drag over event
 */
function handleDragOver(e) {
    e.preventDefault();
    const container = e.currentTarget;
    container.style.borderColor = '#667eea';
    container.style.background = '#edf2f7';
    container.style.transform = 'scale(1.02)';
}

/**
 * Handle drag leave event
 */
function handleDragLeave(e) {
    e.preventDefault();
    const container = e.currentTarget;
    container.style.borderColor = '#cbd5e0';
    container.style.background = '#f8fafc';
    container.style.transform = 'scale(1)';
}

/**
 * Handle drop event
 */
function handleDrop(e, input, label) {
    e.preventDefault();
    const container = e.currentTarget;
    container.style.borderColor = '#cbd5e0';
    container.style.background = '#f8fafc';
    container.style.transform = 'scale(1)';
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        input.files = files;
        updateFileLabel(files[0], label);
        validateFile(files[0], input);
    }
}

/**
 * Handle file input change
 */
function handleFileChange(e, label, originalText) {
    if (e.target.files.length > 0) {
        updateFileLabel(e.target.files[0], label);
        validateFile(e.target.files[0], e.target);
    } else {
        label.innerHTML = originalText;
    }
}

/**
 * Update file label with file information
 */
function updateFileLabel(file, label) {
    const fileName = file.name;
    const fileSize = (file.size / 1024 / 1024).toFixed(2);
    const fileType = file.type;
    
    // Check if file is an image
    if (fileType.startsWith('image/')) {
        label.innerHTML = `
            <div style="color: #667eea; font-weight: 600;">
                <i class="fas fa-check-circle me-1"></i>
                ${fileName}
            </div>
            <small class="text-muted">Ukuran: ${fileSize} MB</small>
        `;
    } else {
        label.innerHTML = `
            <div style="color: #e53e3e; font-weight: 600;">
                <i class="fas fa-exclamation-triangle me-1"></i>
                File tidak valid
            </div>
            <small class="text-muted">Harap pilih file gambar (JPG, PNG, SVG)</small>
        `;
    }
}

/**
 * Validate uploaded file
 */
function validateFile(file, input) {
    const maxSize = input.name === 'logo' ? 2 * 1024 * 1024 : 5 * 1024 * 1024; // 2MB for logo, 5MB for hero
    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/svg+xml'];
    
    if (!allowedTypes.includes(file.type)) {
        showFileError(input, 'Format file tidak didukung. Gunakan JPG, PNG, atau SVG.');
        return false;
    }
    
    if (file.size > maxSize) {
        const maxSizeMB = maxSize / 1024 / 1024;
        showFileError(input, `Ukuran file terlalu besar. Maksimal ${maxSizeMB}MB.`);
        return false;
    }
    
    clearFileError(input);
    return true;
}

/**
 * Show file validation error
 */
function showFileError(input, message) {
    clearFileError(input);
    
    const errorDiv = document.createElement('div');
    errorDiv.className = 'alert-custom file-error';
    errorDiv.innerHTML = `<i class="fas fa-exclamation-circle me-1"></i>${message}`;
    
    input.closest('.file-upload-container').insertAdjacentElement('afterend', errorDiv);
}

/**
 * Clear file validation error
 */
function clearFileError(input) {
    const existingError = input.closest('.form-group').querySelector('.file-error');
    if (existingError) {
        existingError.remove();
    }
}

/**
 * Initialize form validation
 */
function initializeFormValidation() {
    const form = document.querySelector('form');
    const submitBtn = document.querySelector('.btn-submit');
    
    if (form && submitBtn) {
        form.addEventListener('submit', function(e) {
            // Show loading state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
            submitBtn.disabled = true;
            
            // Validate required fields
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('is-invalid');
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                submitBtn.innerHTML = '<i class="fas fa-save me-2"></i>Perbarui Data';
                submitBtn.disabled = false;
                
                // Show error message
                showNotification('Harap lengkapi semua field yang wajib diisi.', 'error');
            }
        });
    }
}

/**
 * Initialize input effects
 */
function initializeInputEffects() {
    const inputs = document.querySelectorAll('.form-control');
    
    inputs.forEach(input => {
        // Focus effects
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'translateY(-2px)';
            this.parentElement.style.transition = 'transform 0.2s ease';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'translateY(0)';
        });
        
        // Real-time validation
        input.addEventListener('input', function() {
            if (this.hasAttribute('required') && this.value.trim()) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            }
        });
    });
}

/**
 * Show notification message
 */
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type === 'error' ? 'danger' : type} alert-dismissible fade show`;
    notification.style.position = 'fixed';
    notification.style.top = '20px';
    notification.style.right = '20px';
    notification.style.zIndex = '9999';
    notification.style.minWidth = '300px';
    
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentElement) {
            notification.remove();
        }
    }, 5000);
}

/**
 * Preview image before upload
 */
function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            const preview = document.getElementById(previewId);
            if (preview) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
        };
        
        reader.readAsDataURL(input.files[0]);
    }
}
