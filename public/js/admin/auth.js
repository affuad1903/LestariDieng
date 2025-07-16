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
        input.setAttribute('autocomplete', 'new-password');
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
    setupPasswordToggle('togglePasswordConfirm', 'password_confirmation');

    // Password Strength Checker
    function checkPasswordStrength(password) {
        const requirements = {
            length: password.length >= 8,
            lowercase: /[a-z]/.test(password),
            uppercase: /[A-Z]/.test(password),
            number: /[0-9]/.test(password),
            special: /[!@#$%^&*(),.?":{}|<>]/.test(password)
        };
        
        const metCount = Object.values(requirements).filter(req => req).length;
        
        let strength = 'weak';
        let strengthText = 'Sangat Lemah';
        
        if (password.length === 0) {
            return { strength: '', strengthText: '', requirements, score: 0 };
        } else if (metCount === 1 || password.length < 6) {
            strength = 'weak';
            strengthText = 'Sangat Lemah';
        } else if (metCount === 2 || password.length < 8) {
            strength = 'fair';
            strengthText = 'Lemah';
        } else if (metCount === 3) {
            strength = 'good';
            strengthText = 'Sedang';
        } else if (metCount === 4) {
            strength = 'strong';
            strengthText = 'Kuat';
        } else if (metCount === 5) {
            strength = 'very-strong';
            strengthText = 'Sangat Kuat';
        }
        
        return { strength, strengthText, requirements, score: metCount };
    }
    
    function updatePasswordStrength(password) {
        const result = checkPasswordStrength(password);
        const strengthElement = document.getElementById('passwordStrength');
        const requirementsElement = document.getElementById('passwordRequirements');
        const strengthText = strengthElement.querySelector('.password-strength-text');
        
        // Update strength indicator
        if (password.length === 0) {
            strengthElement.classList.remove('show');
            requirementsElement.classList.remove('show');
        } else {
            strengthElement.className = `password-strength show ${result.strength}`;
            strengthText.textContent = `Kekuatan Sandi: ${result.strengthText}`;
            requirementsElement.classList.add('show');
        }
        
        // Update requirements
        const reqElements = {
            length: document.getElementById('lengthReq'),
            lowercase: document.getElementById('lowercaseReq'),
            uppercase: document.getElementById('uppercaseReq'),
            number: document.getElementById('numberReq'),
            special: document.getElementById('specialReq')
        };
        
        Object.keys(reqElements).forEach(key => {
            const element = reqElements[key];
            const icon = element.querySelector('.icon');
            
            if (result.requirements[key]) {
                element.classList.add('met');
                icon.className = 'fas fa-check icon';
            } else {
                element.classList.remove('met');
                icon.className = 'fas fa-times icon';
            }
        });
    }

    // Enhanced Form Validation
    const form = document.getElementById('registerForm');
    const submitBtn = document.getElementById('submitBtn');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const passwordConfirmInput = document.getElementById('password_confirmation');

    // Validation functions
    function validateName(value) {
        return value.trim().length >= 3;
    }

    function validateEmail(value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(value);
    }

    function validatePassword(value) {
        const result = checkPasswordStrength(value);
        return value.length >= 8 && result.score >= 2; // Minimal 8 karakter dan minimal 2 requirement terpenuhi
    }
    
    function validatePasswordConfirm(password, confirm) {
        return password === confirm && validatePassword(password);
    }

    // Apply validation styling
    function applyValidationStyle(input, isValid) {
        input.classList.remove('is-valid', 'is-invalid');
        if (input.value.trim() !== '') {
            input.classList.add(isValid ? 'is-valid' : 'is-invalid');
        }
    }

    // Real-time validation
    nameInput.addEventListener('input', function() {
        const isValid = validateName(this.value);
        applyValidationStyle(this, isValid);
    });

    emailInput.addEventListener('input', function() {
        const isValid = validateEmail(this.value);
        applyValidationStyle(this, isValid);
    });

    passwordInput.addEventListener('input', function() {
        updatePasswordStrength(this.value);
        const isValid = validatePassword(this.value);
        applyValidationStyle(this, isValid);
        
        // Also validate password confirmation if it has value
        if (passwordConfirmInput.value) {
            const confirmValid = validatePasswordConfirm(this.value, passwordConfirmInput.value);
            applyValidationStyle(passwordConfirmInput, confirmValid);
        }
    });
    
    passwordInput.addEventListener('focus', function() {
        if (this.value.length === 0) {
            document.getElementById('passwordRequirements').classList.add('show');
        }
    });
    
    passwordInput.addEventListener('blur', function() {
        if (this.value.length === 0) {
            document.getElementById('passwordRequirements').classList.remove('show');
        }
    });

    passwordConfirmInput.addEventListener('input', function() {
        const isValid = validatePasswordConfirm(passwordInput.value, this.value);
        applyValidationStyle(this, isValid);
    });

    // Enhanced form submission
    form.addEventListener('submit', function(e) {
        const name = nameInput.value.trim();
        const email = emailInput.value.trim();
        const password = passwordInput.value;
        const passwordConfirm = passwordConfirmInput.value;

        // Validate all fields
        const nameValid = validateName(name);
        const emailValid = validateEmail(email);
        const passwordValid = validatePassword(password);
        const passwordConfirmValid = validatePasswordConfirm(password, passwordConfirm);

        // Apply validation styles
        applyValidationStyle(nameInput, nameValid);
        applyValidationStyle(emailInput, emailValid);
        applyValidationStyle(passwordInput, passwordValid);
        applyValidationStyle(passwordConfirmInput, passwordConfirmValid);

        // Check if form is valid
        if (!nameValid || !emailValid || !passwordValid || !passwordConfirmValid) {
            e.preventDefault();
            
            // Show specific error messages
            let errorMessage = 'Silakan perbaiki kesalahan berikut:\n';
            if (!nameValid) errorMessage += '• Username minimal 3 karakter\n';
            if (!emailValid) errorMessage += '• Format email tidak valid\n';
            if (!passwordValid) {
                const result = checkPasswordStrength(password);
                if (password.length < 8) {
                    errorMessage += '• Password minimal 8 karakter\n';
                } else if (result.score < 2) {
                    errorMessage += '• Password terlalu lemah, penuhi minimal 2 kriteria keamanan\n';
                }
            }
            if (!passwordConfirmValid) errorMessage += '• Konfirmasi password tidak cocok\n';
            
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
