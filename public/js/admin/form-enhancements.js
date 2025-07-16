/**
 * Admin Forms Enhancement JavaScript
 * Handles auto-selection, form interactions and responsive behavior
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // Auto-select paket based on URL parameter
    function autoSelectPaket() {
        const urlParams = new URLSearchParams(window.location.search);
        const paketId = urlParams.get('paket_id');
        
        if (paketId) {
            // For radio buttons (detail_itinerary)
            const radioInput = document.querySelector(`input[name="paket_id"][value="${paketId}"]`);
            if (radioInput) {
                radioInput.checked = true;
                radioInput.focus();
                
                // Add visual highlight
                const parentDiv = radioInput.closest('.admin-checkbox, .form-check');
                if (parentDiv) {
                    parentDiv.style.background = '#e3f2fd';
                    parentDiv.style.border = '2px solid #2196f3';
                    parentDiv.style.borderRadius = '8px';
                }
            }
            
            // For checkbox inputs (daftar_destinasi, daftar_fasilitas)
            const checkboxInput = document.querySelector(`input[name="paket[]"][value="${paketId}"]`);
            if (checkboxInput) {
                checkboxInput.checked = true;
                
                // Add visual highlight
                const parentDiv = checkboxInput.closest('.admin-checkbox, .form-check');
                if (parentDiv) {
                    parentDiv.style.background = '#e8f5e8';
                    parentDiv.style.border = '2px solid #4caf50';
                    parentDiv.style.borderRadius = '8px';
                }
                
                // Scroll to the selected item
                setTimeout(() => {
                    checkboxInput.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }, 500);
            }
            
            // Show notification
            showNotification(`Paket dengan ID ${paketId} telah dipilih otomatis`, 'success');
        }
    }
    
    // Show notification function
    function showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        notification.style.cssText = `
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        `;
        
        notification.innerHTML = `
            <i class="fas fa-info-circle me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(notification);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 5000);
    }
    
    // Enhanced checkbox/radio interactions
    function enhanceFormInputs() {
        // Add hover effects to form checks
        const formChecks = document.querySelectorAll('.form-check, .admin-checkbox');
        formChecks.forEach(check => {
            check.addEventListener('mouseenter', function() {
                if (!this.querySelector('input:checked')) {
                    this.style.background = '#f8f9fa';
                    this.style.transform = 'translateY(-1px)';
                    this.style.transition = 'all 0.2s ease';
                }
            });
            
            check.addEventListener('mouseleave', function() {
                if (!this.querySelector('input:checked')) {
                    this.style.background = '';
                    this.style.transform = '';
                }
            });
            
            // Add click effect
            check.addEventListener('click', function(e) {
                if (e.target.tagName !== 'INPUT') {
                    const input = this.querySelector('input[type="checkbox"], input[type="radio"]');
                    if (input) {
                        input.click();
                    }
                }
            });
        });
    }
    
    // Form validation enhancement
    function enhanceFormValidation() {
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let hasError = false;
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('is-invalid');
                        hasError = true;
                    } else {
                        field.classList.remove('is-invalid');
                    }
                });
                
                if (hasError) {
                    e.preventDefault();
                    showNotification('Mohon lengkapi semua field yang wajib diisi', 'danger');
                    
                    // Focus first error field
                    const firstError = form.querySelector('.is-invalid');
                    if (firstError) {
                        firstError.focus();
                        firstError.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }
                }
            });
        });
    }
    
    // Enhanced form validation for synchronized forms
    function validateSynchronizedForms() {
        const forms = document.querySelectorAll('form[action*="store"]');
        
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const isSynchronized = form.querySelector('input[name="is_synchronized"]');
                
                if (isSynchronized) {
                    // For synchronized forms, ensure at least one item is being added
                    const hasExistingItems = form.querySelectorAll('input[type="checkbox"]:checked').length > 0;
                    const hasNewItem = form.querySelector('input[name*="baru"], textarea[name="detail"]');
                    const newItemFilled = hasNewItem && hasNewItem.value.trim() !== '';
                    
                    if (!hasExistingItems && !newItemFilled) {
                        e.preventDefault();
                        showFormError('Pilih item yang sudah ada atau tambahkan item baru!');
                        return false;
                    }
                } else {
                    // For normal forms, ensure paket is selected
                    const paketSelected = form.querySelectorAll('input[name="paket[]"]:checked, input[name="paket_id"]:checked').length > 0;
                    
                    if (!paketSelected) {
                        e.preventDefault();
                        showFormError('Pilih minimal satu paket!');
                        return false;
                    }
                }
            });
        });
    }
    
    // Show form error message
    function showFormError(message) {
        // Remove existing error messages
        const existingErrors = document.querySelectorAll('.form-validation-error');
        existingErrors.forEach(error => error.remove());
        
        // Create new error message
        const errorDiv = document.createElement('div');
        errorDiv.className = 'alert alert-danger form-validation-error';
        errorDiv.innerHTML = `<i class="fas fa-exclamation-triangle me-2"></i>${message}`;
        
        // Insert at top of form body
        const formBody = document.querySelector('.admin-form-body');
        if (formBody) {
            formBody.insertBefore(errorDiv, formBody.firstChild);
            errorDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
    
    // Smart form navigation
    function addFormNavigation() {
        const backButtons = document.querySelectorAll('a[href*="dashboard"]');
        backButtons.forEach(button => {
            if (button.textContent.includes('Kembali')) {
                button.addEventListener('click', function(e) {
                    const hasChanges = checkFormChanges();
                    if (hasChanges) {
                        e.preventDefault();
                        if (confirm('Ada perubahan yang belum disimpan. Yakin ingin kembali?')) {
                            window.location.href = this.href;
                        }
                    }
                });
            }
        });
    }
    
    // Check if form has changes
    function checkFormChanges() {
        const inputs = document.querySelectorAll('input, textarea, select');
        let hasChanges = false;
        
        inputs.forEach(input => {
            if (input.type === 'checkbox' || input.type === 'radio') {
                if (input.checked !== input.defaultChecked) {
                    hasChanges = true;
                }
            } else {
                if (input.value !== input.defaultValue) {
                    hasChanges = true;
                }
            }
        });
        
        return hasChanges;
    }
    
    // Responsive form adjustments
    function responsiveFormAdjustments() {
        function adjustForMobile() {
            const isMobile = window.innerWidth < 768;
            const formGroups = document.querySelectorAll('.admin-form-group');
            
            formGroups.forEach(group => {
                if (isMobile) {
                    group.style.marginBottom = '1.5rem';
                } else {
                    group.style.marginBottom = '';
                }
            });
        }
        
        adjustForMobile();
        window.addEventListener('resize', adjustForMobile);
    }
    
    // Initialize all enhancements
    autoSelectPaket();
    enhanceFormInputs();
    enhanceFormValidation();
    validateSynchronizedForms();
    addFormNavigation();
    responsiveFormAdjustments();
    
    // Add loading states to buttons
    const submitButtons = document.querySelectorAll('button[type="submit"]');
    submitButtons.forEach(button => {
        button.addEventListener('click', function() {
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
            this.disabled = true;
            
            // Re-enable button after 10 seconds as fallback
            setTimeout(() => {
                this.innerHTML = originalText;
                this.disabled = false;
            }, 10000);
        });
    });
    
    console.log('Admin Forms Enhancement loaded successfully');
});
