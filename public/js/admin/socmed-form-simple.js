/**
 * Social Media Form JavaScript - Simplified Version
 * Enhanced form interactions without username auto-fill
 */

document.addEventListener('DOMContentLoaded', function() {
    initializePlatformSelect();
    initializeFormValidation();
    initializeInputEffects();
});

/**
 * Platform configurations for icon auto-sync
 */
const platformConfig = {
    facebook: {
        name: 'Facebook',
        icon: 'fab fa-facebook-f',
        color: '#1877F2'
    },
    instagram: {
        name: 'Instagram',
        icon: 'fab fa-instagram',
        color: '#E4405F'
    },
    twitter: {
        name: 'Twitter',
        icon: 'fab fa-twitter',
        color: '#1DA1F2'
    },
    youtube: {
        name: 'YouTube',
        icon: 'fab fa-youtube',
        color: '#FF0000'
    },
    linkedin: {
        name: 'LinkedIn',
        icon: 'fab fa-linkedin-in',
        color: '#0A66C2'
    },
    tiktok: {
        name: 'TikTok',
        icon: 'fab fa-tiktok',
        color: '#000000'
    },
    whatsapp: {
        name: 'WhatsApp',
        icon: 'fab fa-whatsapp',
        color: '#25D366'
    }
};

/**
 * Initialize platform select functionality
 */
function initializePlatformSelect() {
    const platformSelect = document.getElementById('platform');
    const urlInput = document.getElementById('url');
    
    if (platformSelect) {
        platformSelect.addEventListener('change', function() {
            const platform = this.value;
            updatePlatformInterface(platform, urlInput);
        });
        
        // Initialize on page load if platform is already selected
        if (platformSelect.value) {
            updatePlatformInterface(platformSelect.value, urlInput);
        }
    }
}

/**
 * Update interface based on selected platform
 */
function updatePlatformInterface(platform, urlInput) {
    if (!platform || !platformConfig[platform]) {
        resetPlatformInterface(urlInput);
        return;
    }
    
    const config = platformConfig[platform];
    const iconSelect = document.getElementById('icon');
    
    // Auto-select corresponding icon
    if (iconSelect) {
        const iconValue = config.icon;
        for (let option of iconSelect.options) {
            if (option.value === iconValue) {
                iconSelect.value = iconValue;
                break;
            }
        }
    }
    
    // Update URL placeholder with helpful hint
    if (urlInput) {
        urlInput.placeholder = `Masukkan URL ${config.name} lengkap (contoh: https://${platform}.com/username)`;
    }
    
    showNotification(`Platform ${config.name} dipilih. Ikon otomatis disesuaikan.`, 'success');
}

/**
 * Reset platform interface
 */
function resetPlatformInterface(urlInput) {
    const iconSelect = document.getElementById('icon');
    
    if (iconSelect) {
        iconSelect.value = '';
    }
    
    if (urlInput) {
        urlInput.placeholder = 'Masukkan URL lengkap sosial media (contoh: https://instagram.com/username)';
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
            if (!validateForm()) {
                e.preventDefault();
                return;
            }
            
            // Show loading state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
            submitBtn.disabled = true;
            submitBtn.classList.add('btn-loading');
        });
    }
}

/**
 * Validate form data
 */
function validateForm() {
    const platform = document.getElementById('platform').value;
    const url = document.getElementById('url').value.trim();
    const icon = document.getElementById('icon').value;
    
    let isValid = true;
    
    // Validate platform
    if (!platform) {
        showFieldError('platform', 'Platform harus dipilih.');
        isValid = false;
    } else {
        clearFieldError('platform');
    }
    
    // Validate URL
    if (!url) {
        showFieldError('url', 'URL harus diisi.');
        isValid = false;
    } else if (!isValidUrl(url)) {
        showFieldError('url', 'Format URL tidak valid.');
        isValid = false;
    } else if (!url.startsWith('http://') && !url.startsWith('https://')) {
        showFieldError('url', 'URL harus dimulai dengan http:// atau https://');
        isValid = false;
    } else {
        clearFieldError('url');
    }
    
    // Validate icon
    if (!icon) {
        showFieldError('icon', 'Ikon platform harus dipilih.');
        isValid = false;
    } else {
        clearFieldError('icon');
    }
    
    if (!isValid) {
        showNotification('Harap lengkapi semua field yang wajib diisi dengan benar.', 'error');
    }
    
    return isValid;
}

/**
 * Validate URL format
 */
function isValidUrl(string) {
    try {
        new URL(string);
        return true;
    } catch (_) {
        return false;
    }
}

/**
 * Show field validation error
 */
function showFieldError(fieldId, message) {
    const field = document.getElementById(fieldId);
    if (!field) return;
    
    field.classList.add('is-invalid');
    
    // Remove existing error
    clearFieldError(fieldId);
    
    // Add new error
    const errorDiv = document.createElement('div');
    errorDiv.className = 'alert-custom field-error';
    errorDiv.innerHTML = `<i class="fas fa-exclamation-circle me-1"></i>${message}`;
    
    field.closest('.form-group').appendChild(errorDiv);
}

/**
 * Clear field validation error
 */
function clearFieldError(fieldId) {
    const field = document.getElementById(fieldId);
    if (!field) return;
    
    field.classList.remove('is-invalid');
    
    const existingError = field.closest('.form-group').querySelector('.field-error');
    if (existingError) {
        existingError.remove();
    }
}

/**
 * Initialize input effects
 */
function initializeInputEffects() {
    const inputs = document.querySelectorAll('.form-control, .form-select');
    
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
            if (input.hasAttribute('required') && input.value.trim()) {
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
                clearFieldError(input.id);
            }
        });
    });
    
    // URL input specific enhancements
    const urlInput = document.getElementById('url');
    if (urlInput) {
        urlInput.addEventListener('blur', function() {
            let url = this.value.trim();
            if (url && !url.startsWith('http://') && !url.startsWith('https://')) {
                this.value = 'https://' + url;
            }
        });
        
        urlInput.addEventListener('input', function() {
            // Real-time URL validation feedback
            const url = this.value.trim();
            if (url && isValidUrl(url)) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
                clearFieldError('url');
            }
        });
    }
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
 * Utility function for debouncing
 */
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}
