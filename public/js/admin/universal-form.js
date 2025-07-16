/**
 * Universal Form JavaScript
 * Common functionality for all dashboard forms
 */

// Global form utilities
window.FormUtils = {
    
    /**
     * Initialize all form features
     */
    init: function() {
        this.initializeFileUploads();
        this.initializeFormValidation();
        this.initializeInputEffects();
        this.initializeCharacterCounters();
        this.initializeImagePreviews();
    },

    /**
     * Initialize file upload functionality
     */
    initializeFileUploads: function() {
        const fileInputs = document.querySelectorAll('.file-upload-input');
        
        fileInputs.forEach(input => {
            const container = input.closest('.file-upload-container');
            const label = container.querySelector('.file-upload-label');
            const originalText = label.innerHTML;
            
            // Drag and drop handlers
            container.addEventListener('dragover', (e) => this.handleDragOver(e));
            container.addEventListener('dragleave', (e) => this.handleDragLeave(e));
            container.addEventListener('drop', (e) => this.handleDrop(e, input, label));
            
            // File input change handler
            input.addEventListener('change', (e) => this.handleFileChange(e, label, originalText));
        });
    },

    /**
     * Handle drag over event
     */
    handleDragOver: function(e) {
        e.preventDefault();
        const container = e.currentTarget;
        container.style.borderColor = '#667eea';
        container.style.background = '#edf2f7';
        container.style.transform = 'scale(1.02)';
    },

    /**
     * Handle drag leave event
     */
    handleDragLeave: function(e) {
        e.preventDefault();
        const container = e.currentTarget;
        container.style.borderColor = '#cbd5e0';
        container.style.background = '#f8fafc';
        container.style.transform = 'scale(1)';
    },

    /**
     * Handle drop event
     */
    handleDrop: function(e, input, label) {
        e.preventDefault();
        const container = e.currentTarget;
        container.style.borderColor = '#cbd5e0';
        container.style.background = '#f8fafc';
        container.style.transform = 'scale(1)';
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            input.files = files;
            this.updateFileLabel(files[0], label);
            this.validateFile(files[0], input);
        }
    },

    /**
     * Handle file input change
     */
    handleFileChange: function(e, label, originalText) {
        if (e.target.files.length > 0) {
            this.updateFileLabel(e.target.files[0], label);
            this.validateFile(e.target.files[0], e.target);
        } else {
            label.innerHTML = originalText;
        }
    },

    /**
     * Update file label with file information
     */
    updateFileLabel: function(file, label) {
        const fileName = file.name;
        const fileSize = (file.size / 1024 / 1024).toFixed(2);
        const fileType = file.type;
        
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
                <small class="text-muted">Harap pilih file yang sesuai</small>
            `;
        }
    },

    /**
     * Validate uploaded file
     */
    validateFile: function(file, input) {
        const allowedTypes = input.accept ? input.accept.split(',').map(t => t.trim()) : ['image/*'];
        const maxSize = input.dataset.maxSize ? parseInt(input.dataset.maxSize) * 1024 * 1024 : 5 * 1024 * 1024;
        
        // Check file type
        let typeValid = false;
        for (let type of allowedTypes) {
            if (type === 'image/*' && file.type.startsWith('image/')) {
                typeValid = true;
                break;
            } else if (file.type === type) {
                typeValid = true;
                break;
            }
        }
        
        if (!typeValid) {
            this.showFileError(input, 'Format file tidak didukung.');
            return false;
        }
        
        if (file.size > maxSize) {
            const maxSizeMB = maxSize / 1024 / 1024;
            this.showFileError(input, `Ukuran file terlalu besar. Maksimal ${maxSizeMB}MB.`);
            return false;
        }
        
        this.clearFileError(input);
        return true;
    },

    /**
     * Show file validation error
     */
    showFileError: function(input, message) {
        this.clearFileError(input);
        
        const errorDiv = document.createElement('div');
        errorDiv.className = 'alert-custom file-error';
        errorDiv.innerHTML = `<i class="fas fa-exclamation-circle me-1"></i>${message}`;
        
        input.closest('.file-upload-container').insertAdjacentElement('afterend', errorDiv);
    },

    /**
     * Clear file validation error
     */
    clearFileError: function(input) {
        const existingError = input.closest('.form-group').querySelector('.file-error');
        if (existingError) {
            existingError.remove();
        }
    },

    /**
     * Initialize form validation
     */
    initializeFormValidation: function() {
        const forms = document.querySelectorAll('form');
        
        forms.forEach(form => {
            const submitBtn = form.querySelector('.btn-submit');
            
            if (submitBtn) {
                form.addEventListener('submit', (e) => {
                    if (!this.validateForm(form)) {
                        e.preventDefault();
                        return;
                    }
                    
                    // Show loading state
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
                    submitBtn.disabled = true;
                    submitBtn.classList.add('btn-loading');
                    
                    // Store original text for potential error recovery
                    submitBtn.dataset.originalText = originalText;
                });
            }
        });
    },

    /**
     * Validate form
     */
    validateForm: function(form) {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!this.validateField(field)) {
                isValid = false;
            }
        });
        
        if (!isValid) {
            this.showNotification('Harap lengkapi semua field yang wajib diisi.', 'error');
        }
        
        return isValid;
    },

    /**
     * Validate individual field
     */
    validateField: function(field) {
        const value = field.value.trim();
        let isValid = true;
        let message = '';
        
        // Required validation
        if (field.hasAttribute('required') && !value) {
            isValid = false;
            message = 'Field ini wajib diisi.';
        }
        
        // Email validation
        if (field.type === 'email' && value && !this.isValidEmail(value)) {
            isValid = false;
            message = 'Format email tidak valid.';
        }
        
        // URL validation
        if (field.type === 'url' && value && !this.isValidUrl(value)) {
            isValid = false;
            message = 'Format URL tidak valid.';
        }
        
        // Number validation
        if (field.type === 'number' && value) {
            const num = parseFloat(value);
            if (isNaN(num)) {
                isValid = false;
                message = 'Harus berupa angka.';
            } else if (field.min && num < parseFloat(field.min)) {
                isValid = false;
                message = `Nilai minimum adalah ${field.min}.`;
            } else if (field.max && num > parseFloat(field.max)) {
                isValid = false;
                message = `Nilai maksimum adalah ${field.max}.`;
            }
        }
        
        // Show/hide error
        if (isValid) {
            this.clearFieldError(field);
            field.classList.remove('is-invalid');
            field.classList.add('is-valid');
        } else {
            this.showFieldError(field, message);
            field.classList.remove('is-valid');
            field.classList.add('is-invalid');
        }
        
        return isValid;
    },

    /**
     * Show field validation error
     */
    showFieldError: function(field, message) {
        this.clearFieldError(field);
        
        const errorDiv = document.createElement('div');
        errorDiv.className = 'alert-custom field-error';
        errorDiv.innerHTML = `<i class="fas fa-exclamation-circle me-1"></i>${message}`;
        
        field.closest('.form-group').appendChild(errorDiv);
    },

    /**
     * Clear field validation error
     */
    clearFieldError: function(field) {
        const existingError = field.closest('.form-group').querySelector('.field-error');
        if (existingError) {
            existingError.remove();
        }
    },

    /**
     * Initialize input effects
     */
    initializeInputEffects: function() {
        const inputs = document.querySelectorAll('.form-control, .form-select, .form-textarea');
        
        inputs.forEach(input => {
            // Focus effects
            input.addEventListener('focus', function() {
                this.closest('.form-group').style.transform = 'translateY(-2px)';
                this.closest('.form-group').style.transition = 'transform 0.2s ease';
            });
            
            input.addEventListener('blur', function() {
                this.closest('.form-group').style.transform = 'translateY(0)';
            });
            
            // Real-time validation
            input.addEventListener('input', (e) => {
                if (input.hasAttribute('required')) {
                    this.validateField(input);
                }
                
                // Update character counter if exists
                this.updateCharacterCounter(input);
            });
        });
    },

    /**
     * Initialize character counters
     */
    initializeCharacterCounters: function() {
        const fieldsWithCounters = document.querySelectorAll('[data-max-length]');
        
        fieldsWithCounters.forEach(field => {
            const maxLength = parseInt(field.dataset.maxLength);
            const counter = document.createElement('div');
            counter.className = 'character-counter';
            
            field.closest('.form-group').appendChild(counter);
            
            this.updateCharacterCounter(field);
        });
    },

    /**
     * Update character counter
     */
    updateCharacterCounter: function(field) {
        const maxLength = parseInt(field.dataset.maxLength);
        if (!maxLength) return;
        
        const counter = field.closest('.form-group').querySelector('.character-counter');
        if (!counter) return;
        
        const currentLength = field.value.length;
        const remaining = maxLength - currentLength;
        
        counter.textContent = `${currentLength}/${maxLength}`;
        
        // Update counter color based on remaining characters
        counter.classList.remove('warning', 'danger');
        if (remaining < maxLength * 0.1) {
            counter.classList.add('danger');
        } else if (remaining < maxLength * 0.2) {
            counter.classList.add('warning');
        }
    },

    /**
     * Initialize image previews
     */
    initializeImagePreviews: function() {
        const imageInputs = document.querySelectorAll('input[type="file"][accept*="image"]');
        
        imageInputs.forEach(input => {
            input.addEventListener('change', (e) => {
                this.showImagePreview(e.target);
            });
        });
    },

    /**
     * Show image preview
     */
    showImagePreview: function(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const reader = new FileReader();
            
            reader.onload = function(e) {
                // Remove existing preview
                const existingPreview = input.closest('.form-group').querySelector('.image-preview');
                if (existingPreview) {
                    existingPreview.remove();
                }
                
                // Create new preview
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'image-preview';
                img.alt = 'Preview';
                
                input.closest('.file-upload-container').insertAdjacentElement('afterend', img);
            };
            
            reader.readAsDataURL(file);
        }
    },

    /**
     * Validation helpers
     */
    isValidEmail: function(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    },

    isValidUrl: function(string) {
        try {
            new URL(string);
            return true;
        } catch (_) {
            return false;
        }
    },

    /**
     * Show notification message
     */
    showNotification: function(message, type = 'info') {
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
    },

    /**
     * Utility function for debouncing
     */
    debounce: function(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    },

    /**
     * Reset form to initial state
     */
    resetForm: function(form) {
        // Reset form fields
        form.reset();
        
        // Clear validation states
        const fields = form.querySelectorAll('.form-control, .form-select, .form-textarea');
        fields.forEach(field => {
            field.classList.remove('is-valid', 'is-invalid');
            this.clearFieldError(field);
        });
        
        // Clear file previews
        const previews = form.querySelectorAll('.image-preview');
        previews.forEach(preview => preview.remove());
        
        // Reset file upload labels
        const fileLabels = form.querySelectorAll('.file-upload-label');
        fileLabels.forEach(label => {
            // You might want to store original text in data attribute
            const originalText = label.dataset.originalText || label.innerHTML;
            label.innerHTML = originalText;
        });
        
        // Reset submit button
        const submitBtn = form.querySelector('.btn-submit');
        if (submitBtn && submitBtn.dataset.originalText) {
            submitBtn.innerHTML = submitBtn.dataset.originalText;
            submitBtn.disabled = false;
            submitBtn.classList.remove('btn-loading');
        }
    }
};

// Auto-initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    FormUtils.init();
});
