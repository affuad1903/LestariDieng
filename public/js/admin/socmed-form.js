/**
 * Social Media Form JavaScript
 * Enhanced form interactions and auto-fill functionality
 */

document.addEventListener('DOMContentLoaded', function() {
    initializePlatformSelect();
    initializeAutoFill();
    initializeFormValidation();
    initializeInputEffects();
    initializeUrlPreview();
});

/**
 * Platform configurations
 */
const platformConfig = {
    facebook: {
        name: 'Facebook',
        icon: 'fab fa-facebook-f',
        color: '#1877F2',
        baseUrl: 'https://facebook.com/',
        placeholder: 'nama.pengguna atau nama.halaman'
    },
    instagram: {
        name: 'Instagram',
        icon: 'fab fa-instagram',
        color: '#E4405F',
        baseUrl: 'https://instagram.com/',
        placeholder: 'nama.pengguna'
    },
    twitter: {
        name: 'Twitter',
        icon: 'fab fa-twitter',
        color: '#1DA1F2',
        baseUrl: 'https://twitter.com/',
        placeholder: 'nama.pengguna'
    },
    youtube: {
        name: 'YouTube',
        icon: 'fab fa-youtube',
        color: '#FF0000',
        baseUrl: 'https://youtube.com/@',
        placeholder: 'nama.channel'
    },
    linkedin: {
        name: 'LinkedIn',
        icon: 'fab fa-linkedin-in',
        color: '#0A66C2',
        baseUrl: 'https://linkedin.com/in/',
        placeholder: 'nama.profil'
    },
    tiktok: {
        name: 'TikTok',
        icon: 'fab fa-tiktok',
        color: '#000000',
        baseUrl: 'https://tiktok.com/@',
        placeholder: 'nama.pengguna'
    },
    whatsapp: {
        name: 'WhatsApp',
        icon: 'fab fa-whatsapp',
        color: '#25D366',
        baseUrl: 'https://wa.me/',
        placeholder: '628123456789'
    }
};

/**
 * Initialize platform select functionality
 */
function initializePlatformSelect() {
    const platformSelect = document.getElementById('platform');
    const usernameGroup = document.querySelector('.username-group');
    const urlInput = document.getElementById('url');
    
    if (platformSelect) {
        platformSelect.addEventListener('change', function() {
            const platform = this.value;
            updatePlatformInterface(platform, usernameGroup, urlInput);
        });
        
        // Initialize on page load if platform is already selected
        if (platformSelect.value) {
            updatePlatformInterface(platformSelect.value, usernameGroup, urlInput);
        }
    }
}

/**
 * Update interface based on selected platform
 */
function updatePlatformInterface(platform, usernameGroup, urlInput) {
    if (!platform || !platformConfig[platform]) {
        resetPlatformInterface(usernameGroup);
        return;
    }
    
    const config = platformConfig[platform];
    const icon = usernameGroup.querySelector('.input-group-icon i');
    const input = usernameGroup.querySelector('#username');
    const autoFillBtn = usernameGroup.querySelector('.btn-auto-fill');
    const iconSelect = document.getElementById('icon');
    
    // Update icon
    if (icon) {
        icon.className = `${config.icon} platform-${platform}`;
        icon.style.color = config.color;
    }
    
    // Update placeholder
    if (input) {
        input.placeholder = config.placeholder;
        input.dataset.platform = platform;
    }
    
    // Update auto-fill button
    if (autoFillBtn) {
        autoFillBtn.style.display = 'inline-block';
        autoFillBtn.innerHTML = `<i class="fas fa-magic me-1"></i>Isi Otomatis`;
    }
    
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
    
    // Clear URL input for new platform
    if (urlInput) {
        urlInput.value = '';
        urlInput.placeholder = `URL akan dibuat otomatis untuk ${config.name}`;
    }
    
    // Update URL preview
    updateUrlPreview();
}

/**
 * Reset platform interface
 */
function resetPlatformInterface(usernameGroup) {
    const icon = usernameGroup.querySelector('.input-group-icon i');
    const input = usernameGroup.querySelector('#username');
    const autoFillBtn = usernameGroup.querySelector('.btn-auto-fill');
    
    if (icon) {
        icon.className = 'fas fa-user';
        icon.style.color = '#667eea';
    }
    
    if (input) {
        input.placeholder = 'Pilih platform terlebih dahulu';
        input.value = '';
        delete input.dataset.platform;
    }
    
    if (autoFillBtn) {
        autoFillBtn.style.display = 'none';
    }
}

/**
 * Initialize auto-fill functionality
 */
function initializeAutoFill() {
    const autoFillBtn = document.querySelector('.btn-auto-fill');
    const usernameInput = document.getElementById('username');
    const urlInput = document.getElementById('url');
    
    if (autoFillBtn) {
        autoFillBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            const platform = usernameInput.dataset.platform;
            const username = usernameInput.value.trim();
            
            if (!platform || !username) {
                showNotification('Pilih platform dan masukkan username terlebih dahulu.', 'warning');
                return;
            }
            
            autoFillUrl(platform, username, urlInput, autoFillBtn);
        });
    }
    
    // Auto-update URL on username input
    if (usernameInput) {
        usernameInput.addEventListener('input', debounce(function() {
            updateUrlPreview();
        }, 500));
    }
}

/**
 * Auto-fill URL based on platform and username
 */
function autoFillUrl(platform, username, urlInput, btn) {
    if (!platformConfig[platform]) return;
    
    // Show loading state
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Mengisi...';
    btn.disabled = true;
    
    setTimeout(() => {
        const config = platformConfig[platform];
        let fullUrl = '';
        
        // Special handling for WhatsApp
        if (platform === 'whatsapp') {
            // Remove any non-numeric characters for WhatsApp
            const cleanNumber = username.replace(/\D/g, '');
            fullUrl = config.baseUrl + cleanNumber;
        } else {
            // Remove @ symbol if present
            const cleanUsername = username.replace(/^@/, '');
            fullUrl = config.baseUrl + cleanUsername;
        }
        
        urlInput.value = fullUrl;
        urlInput.classList.add('is-valid');
        
        // Update hidden username field if exists
        const hiddenUsername = document.getElementById('username_hidden');
        if (hiddenUsername) {
            hiddenUsername.value = username;
        }
        
        // Update preview
        updateUrlPreview();
        
        // Reset button
        btn.innerHTML = '<i class="fas fa-check me-1"></i>Berhasil!';
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.disabled = false;
        }, 1500);
        
        showNotification(`URL ${config.name} berhasil dibuat!`, 'success');
    }, 1000);
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
    const username = document.getElementById('username').value.trim();
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
    
    // Validate username
    if (!username) {
        showFieldError('username', 'Username/handle harus diisi.');
        isValid = false;
    } else if (platform === 'whatsapp' && !/^\d+$/.test(username.replace(/\D/g, ''))) {
        showFieldError('username', 'Nomor WhatsApp harus berupa angka.');
        isValid = false;
    } else {
        clearFieldError('username');
    }
    
    // Validate URL
    if (!url) {
        showFieldError('url', 'URL harus diisi.');
        isValid = false;
    } else if (!isValidUrl(url)) {
        showFieldError('url', 'Format URL tidak valid.');
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
        input.addEventListener('input', function() {
            if (this.value.trim()) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            }
        });
    });
}

/**
 * Initialize URL preview
 */
function initializeUrlPreview() {
    updateUrlPreview();
}

/**
 * Update URL preview
 */
function updateUrlPreview() {
    const platformSelect = document.getElementById('platform');
    const usernameInput = document.getElementById('username');
    const urlInput = document.getElementById('url');
    
    if (!platformSelect || !usernameInput || !urlInput) return;
    
    const platform = platformSelect.value;
    const username = usernameInput.value.trim();
    
    let previewContainer = document.querySelector('.url-preview');
    
    if (!platform || !username) {
        if (previewContainer) {
            previewContainer.remove();
        }
        return;
    }
    
    if (!previewContainer) {
        previewContainer = document.createElement('div');
        previewContainer.className = 'url-preview';
        urlInput.parentElement.appendChild(previewContainer);
    }
    
    const config = platformConfig[platform];
    if (config) {
        let previewUrl = '';
        
        if (platform === 'whatsapp') {
            const cleanNumber = username.replace(/\D/g, '');
            previewUrl = config.baseUrl + cleanNumber;
        } else {
            const cleanUsername = username.replace(/^@/, '');
            previewUrl = config.baseUrl + cleanUsername;
        }
        
        previewContainer.innerHTML = `
            <i class="${config.icon}" style="color: ${config.color}; margin-right: 8px;"></i>
            <strong>Preview:</strong> ${previewUrl}
        `;
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
 * Debounce function to limit function calls
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
