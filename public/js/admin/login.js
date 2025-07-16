document.addEventListener('DOMContentLoaded', function() {
    // Create floating bubbles
    function createFloatingBubbles() {
        const bubbleCount = 5;
        for (let i = 0; i < bubbleCount; i++) {
            const bubble = document.createElement('div');
            bubble.className = 'floating-bubble';
            document.body.appendChild(bubble);
        }
    }
    
    // Initialize floating bubbles
    createFloatingBubbles();

    // Remove default password icons from browser/Bootstrap
    const passwordInputs = document.querySelectorAll('input[type="password"]');
    passwordInputs.forEach(input => {
        // Remove background image (browser default icons)
        input.style.backgroundImage = 'none';
        input.style.backgroundRepeat = 'no-repeat';
        input.style.backgroundPosition = 'right center';
        
        // Remove reveal button for IE/Edge
        input.style.webkitAppearance = 'none';
        input.style.mozAppearance = 'textfield';
        
        // Additional attributes to disable browser password features
        input.setAttribute('autocomplete', 'current-password');
    });

    // Loading overlay
    const loadingOverlay = document.createElement('div');
    loadingOverlay.className = 'loading-overlay';
    loadingOverlay.innerHTML = '<div class="loading-spinner"></div>';
    document.body.appendChild(loadingOverlay);

    // Password Toggle Functionality
    function setupPasswordToggle(toggleId, passwordId) {
        const toggle = document.getElementById(toggleId);
        const password = document.getElementById(passwordId);
        
        if (toggle && password) {
            toggle.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                const icon = this.querySelector('i');
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
                
                // Add visual feedback without changing position
                this.style.transform = 'scale(1.2)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 150);
            });
        }
    }

    setupPasswordToggle('togglePassword', 'password');

    // Enhanced Form Validation
    const form = document.getElementById('loginForm');
    const submitBtn = document.getElementById('submitBtn');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');

    // Validation functions
    function validateEmail(value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(value);
    }

    function validatePassword(value) {
        return value.length >= 8;
    }

    // Apply validation styling
    function applyValidationStyle(input, isValid) {
        input.classList.remove('is-valid', 'is-invalid');
        if (input.value.trim() !== '') {
            input.classList.add(isValid ? 'is-valid' : 'is-invalid');
        }
    }

    // Real-time validation
    emailInput.addEventListener('input', function() {
        const isValid = validateEmail(this.value);
        applyValidationStyle(this, isValid);
    });

    passwordInput.addEventListener('input', function() {
        const isValid = validatePassword(this.value);
        applyValidationStyle(this, isValid);
    });

    // Enhanced form submission
    form.addEventListener('submit', function(e) {
        const email = emailInput.value.trim();
        const password = passwordInput.value;

        // Validate all fields
        const emailValid = validateEmail(email);
        const passwordValid = validatePassword(password);

        // Apply validation styles
        applyValidationStyle(emailInput, emailValid);
        applyValidationStyle(passwordInput, passwordValid);

        // Check if form is valid
        if (!emailValid || !passwordValid) {
            e.preventDefault();
            
            // Show specific error messages
            let errorMessage = 'Silakan perbaiki kesalahan berikut:\n';
            if (!emailValid) errorMessage += '• Format email tidak valid\n';
            if (!passwordValid) errorMessage += '• Password minimal 8 karakter\n';
            
            alert(errorMessage);
            return false;
        }
        
        // Show loading state
        submitBtn.innerHTML = '<span class="spinner"></span><span class="btn-text">Memproses...</span>';
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;
        
        // Show loading overlay
        loadingOverlay.style.display = 'flex';
    });

    // Enhanced input focus effects
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
            this.style.transform = 'translateY(-2px)';
        });
        
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
            this.style.transform = 'translateY(0)';
        });

        // Add smooth typing effect
        input.addEventListener('input', function() {
            this.style.transform = 'translateY(-1px)';
            setTimeout(() => {
                this.style.transform = this.matches(':focus') ? 'translateY(-2px)' : 'translateY(0)';
            }, 100);
        });
    });

    // Add entrance animation
    setTimeout(() => {
        document.querySelector('.register-card').style.opacity = '0';
        document.querySelector('.register-card').style.transform = 'translateY(50px) scale(0.9)';
        
        setTimeout(() => {
            document.querySelector('.register-card').style.transition = 'all 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
            document.querySelector('.register-card').style.opacity = '1';
            document.querySelector('.register-card').style.transform = 'translateY(0) scale(1)';
        }, 100);
    }, 50);

    // Smooth scroll to error if any
    const errorAlert = document.querySelector('.alert-danger');
    if (errorAlert) {
        errorAlert.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    // Add keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.key === 'Enter') {
            form.dispatchEvent(new Event('submit'));
        }
    });

    // Enhanced button hover effects
    submitBtn.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-3px) scale(1.02)';
    });

    submitBtn.addEventListener('mouseleave', function() {
        if (!this.disabled) {
            this.style.transform = 'translateY(0) scale(1)';
        }
    });
});
