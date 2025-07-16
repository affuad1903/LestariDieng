/**
 * Admin Forms - Master JavaScript
 * Functionality konsisten untuk semua form di dashboard admin
 * Created: July 2025
 */

// Namespace untuk semua fungsi form admin
window.AdminForms = {
    
    /**
     * Initialize all form features
     */
    init: function() {
        this.initializeFileUploads();
        this.initializeFormValidation();
        this.initializeInputEffects();
        this.initializeCharacterCounters();
        this.initializeImagePreviews();
        this.initializeSelectEnhancements();
        this.initializeFormSubmission();
        
        console.log('Admin Forms initialized successfully');
    },

    /**
     * Initialize file upload functionality
     */
    initializeFileUploads: function() {
        const fileInputs = document.querySelectorAll('.admin-file-upload-input');
        
        fileInputs.forEach(input => {
            const container = input.closest('.admin-file-upload-container');
            if (!container) return;
            
            const label = container.querySelector('.admin-file-upload-label');
            const originalText = label.innerHTML;
            
            // Drag and drop handlers
            container.addEventListener('dragover', (e) => this.handleDragOver(e, container));
            container.addEventListener('dragleave', (e) => this.handleDragLeave(e, container));
            container.addEventListener('drop', (e) => this.handleDrop(e, input, label, container));
            
            // File input change handler
            input.addEventListener('change', (e) => this.handleFileChange(e, label, originalText));
            
            // Click handler for container
            container.addEventListener('click', (e) => {
                if (e.target === container || e.target === label || e.target.closest('.admin-file-upload-icon')) {
                    input.click();
                }
            });
        });
    },

    /**
     * Handle drag over event
     */
    handleDragOver: function(e, container) {
        e.preventDefault();
        e.stopPropagation();
        container.classList.add('drag-over');
    },

    /**
     * Handle drag leave event
     */
    handleDragLeave: function(e, container) {
        e.preventDefault();
        e.stopPropagation();
        // Check if we're actually leaving the container
        if (!container.contains(e.relatedTarget)) {
            container.classList.remove('drag-over');
        }
    },

    /**
     * Handle drop event
     */
    handleDrop: function(e, input, label, container) {
        e.preventDefault();
        e.stopPropagation();
        container.classList.remove('drag-over');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            // Set files to input
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(files[0]);
            input.files = dataTransfer.files;
            
            this.updateFileLabel(files[0], label);
            this.validateFile(files[0], input);
            
            // Trigger change event
            input.dispatchEvent(new Event('change', { bubbles: true }));
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
            this.removeFileInfo(label);
        }
    },

    /**
     * Update file label with file information
     */
    updateFileLabel: function(file, label) {
        const fileName = file.name;
        const fileSize = (file.size / 1024 / 1024).toFixed(2);
        const fileType = file.type;
        
        // Remove existing file info
        this.removeFileInfo(label);
        
        // Create new file info
        const fileInfo = document.createElement('div');
        fileInfo.className = 'admin-file-info';
        fileInfo.innerHTML = `
            <i class="fas fa-file-alt me-2"></i>
            <strong>${fileName}</strong><br>
            <small>Ukuran: ${fileSize} MB | Tipe: ${fileType}</small>
        `;
        
        label.parentNode.appendChild(fileInfo);
        
        // Update label text
        label.innerHTML = `
            <i class="fas fa-check-circle"></i> File dipilih
            <br><small class="text-muted">Klik untuk mengganti file</small>
        `;
    },

    /**
     * Remove file info display
     */
    removeFileInfo: function(label) {
        const container = label.closest('.admin-file-upload-container');
        const existingInfo = container.querySelector('.admin-file-info');
        if (existingInfo) {
            existingInfo.remove();
        }
    },

    /**
     * Validate uploaded file
     */
    validateFile: function(file, input) {
        const maxSize = parseInt(input.dataset.maxSize) || 5; // Default 5MB
        const allowedTypes = input.dataset.allowedTypes ? input.dataset.allowedTypes.split(',') : ['image/jpeg', 'image/png', 'image/gif'];
        
        let isValid = true;
        let errorMessage = '';
        
        // Check file size
        if (file.size > maxSize * 1024 * 1024) {
            isValid = false;
            errorMessage = `Ukuran file terlalu besar. Maksimal ${maxSize}MB.`;
        }
        
        // Check file type
        if (!allowedTypes.includes(file.type)) {
            isValid = false;
            errorMessage = `Tipe file tidak diizinkan. Hanya: ${allowedTypes.join(', ')}`;
        }
        
        // Show validation result
        this.showFileValidation(input, isValid, errorMessage);
        
        return isValid;
    },

    /**
     * Show file validation result
     */
    showFileValidation: function(input, isValid, errorMessage) {
        const container = input.closest('.admin-file-upload-container');
        
        // Remove existing validation
        const existingError = container.parentNode.querySelector('.admin-error-message');
        if (existingError) existingError.remove();
        
        if (!isValid) {
            input.classList.add('is-invalid');
            
            const errorDiv = document.createElement('div');
            errorDiv.className = 'admin-error-message';
            errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i>${errorMessage}`;
            
            container.parentNode.appendChild(errorDiv);
        } else {
            input.classList.remove('is-invalid');
        }
    },

    /**
     * Initialize form validation
     */
    initializeFormValidation: function() {
        const forms = document.querySelectorAll('form');
        
        forms.forEach(form => {
            form.addEventListener('submit', (e) => this.handleFormSubmit(e, form));
            
            // Real-time validation for inputs
            const inputs = form.querySelectorAll('.admin-form-control, .admin-form-select, .admin-form-textarea');
            inputs.forEach(input => {
                input.addEventListener('blur', () => this.validateInput(input));
                input.addEventListener('input', () => this.clearInputError(input));
            });
        });
    },

    /**
     * Handle form submission
     */
    handleFormSubmit: function(e, form) {
        let isValid = true;
        
        // Validate all required fields
        const requiredInputs = form.querySelectorAll('[required]');
        requiredInputs.forEach(input => {
            if (!this.validateInput(input)) {
                isValid = false;
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            this.showFormError('Mohon lengkapi semua field yang wajib diisi.');
            return false;
        }
        
        // Show loading state
        this.showFormLoading(form);
        
        return true;
    },

    /**
     * Validate individual input
     */
    validateInput: function(input) {
        let isValid = true;
        let errorMessage = '';
        
        // Check if required
        if (input.hasAttribute('required') && !input.value.trim()) {
            isValid = false;
            errorMessage = 'Field ini wajib diisi.';
        }
        
        // Check email format
        if (input.type === 'email' && input.value && !this.isValidEmail(input.value)) {
            isValid = false;
            errorMessage = 'Format email tidak valid.';
        }
        
        // Check URL format
        if (input.type === 'url' && input.value && !this.isValidURL(input.value)) {
            isValid = false;
            errorMessage = 'Format URL tidak valid.';
        }
        
        // Check number range
        if (input.type === 'number' && input.value) {
            const min = parseInt(input.min);
            const max = parseInt(input.max);
            const value = parseInt(input.value);
            
            if (!isNaN(min) && value < min) {
                isValid = false;
                errorMessage = `Nilai minimal ${min}.`;
            }
            
            if (!isNaN(max) && value > max) {
                isValid = false;
                errorMessage = `Nilai maksimal ${max}.`;
            }
        }
        
        // Show validation result
        this.showInputValidation(input, isValid, errorMessage);
        
        return isValid;
    },

    /**
     * Show input validation result
     */
    showInputValidation: function(input, isValid, errorMessage) {
        const formGroup = input.closest('.admin-form-group');
        if (!formGroup) return;
        
        // Remove existing error
        const existingError = formGroup.querySelector('.admin-error-message');
        if (existingError) existingError.remove();
        
        if (!isValid) {
            input.classList.add('is-invalid');
            
            const errorDiv = document.createElement('div');
            errorDiv.className = 'admin-error-message';
            errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i>${errorMessage}`;
            
            formGroup.appendChild(errorDiv);
        } else {
            input.classList.remove('is-invalid');
        }
    },

    /**
     * Clear input error state
     */
    clearInputError: function(input) {
        input.classList.remove('is-invalid');
        const formGroup = input.closest('.admin-form-group');
        if (formGroup) {
            const errorMessage = formGroup.querySelector('.admin-error-message');
            if (errorMessage) errorMessage.remove();
        }
    },

    /**
     * Initialize input effects
     */
    initializeInputEffects: function() {
        const inputs = document.querySelectorAll('.admin-form-control, .admin-form-select, .admin-form-textarea');
        
        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                const formGroup = input.closest('.admin-form-group');
                if (formGroup) formGroup.style.transform = 'translateY(-2px)';
            });
            
            input.addEventListener('blur', () => {
                const formGroup = input.closest('.admin-form-group');
                if (formGroup) formGroup.style.transform = 'translateY(0)';
            });
        });
    },

    /**
     * Initialize character counters
     */
    initializeCharacterCounters: function() {
        const textInputs = document.querySelectorAll('.admin-form-control[maxlength], .admin-form-textarea[maxlength]');
        
        textInputs.forEach(input => {
            const maxLength = parseInt(input.getAttribute('maxlength'));
            if (!maxLength) return;
            
            // Create counter element
            const counter = document.createElement('div');
            counter.className = 'admin-char-counter';
            
            const formGroup = input.closest('.admin-form-group');
            if (formGroup) {
                formGroup.appendChild(counter);
            }
            
            // Update counter
            const updateCounter = () => {
                const currentLength = input.value.length;
                const remaining = maxLength - currentLength;
                
                counter.textContent = `${currentLength}/${maxLength}`;
                
                // Add warning classes
                counter.classList.remove('warning', 'danger');
                if (remaining <= 20) {
                    counter.classList.add('warning');
                }
                if (remaining <= 5) {
                    counter.classList.add('danger');
                }
            };
            
            input.addEventListener('input', updateCounter);
            updateCounter(); // Initial update
        });
    },

    /**
     * Initialize image previews
     */
    initializeImagePreviews: function() {
        const imageInputs = document.querySelectorAll('input[type="file"][accept*="image"]');
        
        imageInputs.forEach(input => {
            input.addEventListener('change', (e) => {
                if (e.target.files.length > 0) {
                    this.showImagePreview(e.target.files[0], input);
                }
            });
        });
    },

    /**
     * Show image preview
     */
    showImagePreview: function(file, input) {
        const reader = new FileReader();
        
        reader.onload = (e) => {
            const container = input.closest('.admin-file-upload-container');
            if (!container) return;
            
            // Remove existing preview
            const existingPreview = container.querySelector('.admin-image-preview');
            if (existingPreview) existingPreview.remove();
            
            // Create preview
            const preview = document.createElement('div');
            preview.className = 'admin-image-preview';
            preview.style.cssText = `
                margin-top: 1rem;
                text-align: center;
            `;
            
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.cssText = `
                max-width: 200px;
                max-height: 150px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            `;
            
            preview.appendChild(img);
            container.appendChild(preview);
        };
        
        reader.readAsDataURL(file);
    },

    /**
     * Initialize select enhancements
     */
    initializeSelectEnhancements: function() {
        const selects = document.querySelectorAll('.admin-form-select');
        
        selects.forEach(select => {
            // Add change event for dynamic content
            select.addEventListener('change', (e) => {
                this.handleSelectChange(e.target);
            });
        });
    },

    /**
     * Handle select change events
     */
    handleSelectChange: function(select) {
        // Platform and icon synchronization for social media forms
        if (select.id === 'platform') {
            const iconSelect = document.getElementById('icon');
            if (iconSelect) {
                const platformValue = select.value;
                const iconMap = {
                    'facebook': 'fab fa-facebook-f',
                    'instagram': 'fab fa-instagram',
                    'twitter': 'fab fa-twitter',
                    'youtube': 'fab fa-youtube',
                    'linkedin': 'fab fa-linkedin-in',
                    'tiktok': 'fab fa-tiktok',
                    'whatsapp': 'fab fa-whatsapp'
                };
                
                if (iconMap[platformValue]) {
                    iconSelect.value = iconMap[platformValue];
                }
            }
        }
    },

    /**
     * Initialize form submission handling
     */
    initializeFormSubmission: function() {
        const submitButtons = document.querySelectorAll('.admin-btn-primary[type="submit"]');
        
        submitButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                // Prevent double submission
                if (button.disabled) {
                    e.preventDefault();
                    return false;
                }
                
                // Add slight delay to show loading state
                setTimeout(() => {
                    button.disabled = true;
                    button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
                }, 100);
            });
        });
    },

    /**
     * Show form loading state
     */
    showFormLoading: function(form) {
        form.classList.add('admin-form-loading');
        
        const submitButton = form.querySelector('.admin-btn-primary[type="submit"]');
        if (submitButton) {
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
        }
    },

    /**
     * Show form error message
     */
    showFormError: function(message) {
        // Remove existing error
        const existingError = document.querySelector('.admin-form-error-global');
        if (existingError) existingError.remove();
        
        const errorDiv = document.createElement('div');
        errorDiv.className = 'admin-error-message admin-form-error-global';
        errorDiv.style.cssText = 'margin-bottom: 1rem;';
        errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i>${message}`;
        
        const formBody = document.querySelector('.admin-form-body');
        if (formBody) {
            formBody.insertBefore(errorDiv, formBody.firstChild);
        }
        
        // Scroll to error
        errorDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
    },

    /**
     * Utility functions
     */
    isValidEmail: function(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    },

    isValidURL: function(url) {
        try {
            new URL(url);
            return true;
        } catch {
            return false;
        }
    },

    /**
     * Format file size
     */
    formatFileSize: function(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
};

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    AdminForms.init();
});

// Global access for manual initialization
window.initAdminForms = function() {
    AdminForms.init();
};
