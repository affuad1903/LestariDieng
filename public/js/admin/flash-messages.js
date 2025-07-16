/**
 * Flash Messages - JavaScript
 * Handles enhanced flash message interactions and auto-hide functionality
 * Created: July 2025
 */

class FlashMessages {
    constructor() {
        this.init();
    }

    init() {
        // Initialize auto-hide for alerts
        this.initAutoHide();
        
        // Initialize enhanced interactions
        this.initInteractions();
        
        // Initialize sound effects (optional)
        this.initSoundEffects();
    }

    initAutoHide() {
        const alerts = document.querySelectorAll('.alert');
        
        alerts.forEach(alert => {
            // Add auto-hide class for animation
            alert.classList.add('auto-hide');
            
            // Auto-hide after 5 seconds
            setTimeout(() => {
                if (alert && alert.parentNode) {
                    this.hideAlert(alert);
                }
            }, 5000);
        });
    }

    initInteractions() {
        // Enhanced close button behavior
        const closeButtons = document.querySelectorAll('.alert .btn-close');
        
        closeButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const alert = button.closest('.alert');
                this.hideAlert(alert);
            });
        });

        // Click anywhere on alert to dismiss (optional)
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            alert.addEventListener('click', (e) => {
                // Only if clicked outside the content area
                if (e.target === alert) {
                    this.hideAlert(alert);
                }
            });

            // Pause auto-hide on hover
            alert.addEventListener('mouseenter', () => {
                alert.style.animationPlayState = 'paused';
            });

            alert.addEventListener('mouseleave', () => {
                alert.style.animationPlayState = 'running';
            });
        });
    }

    hideAlert(alert) {
        if (!alert) return;

        // Add fade-out animation
        alert.style.animation = 'fadeOut 0.3s ease-out forwards';
        
        // Remove from DOM after animation
        setTimeout(() => {
            if (alert && alert.parentNode) {
                alert.remove();
            }
        }, 300);
    }

    initSoundEffects() {
        // Optional: Add subtle sound effects for different alert types
        const successAlerts = document.querySelectorAll('.alert-success');
        const errorAlerts = document.querySelectorAll('.alert-danger');

        // You can add audio elements here if desired
        // Example:
        // successAlerts.forEach(alert => {
        //     this.playSound('success');
        // });
    }

    // Method to show dynamic flash messages (for AJAX operations)
    static show(type, title, message, duration = 5000) {
        const alertContainer = document.createElement('div');
        alertContainer.className = `alert alert-${type} alert-dismissible fade show shadow-sm auto-hide`;
        alertContainer.setAttribute('role', 'alert');

        const iconMap = {
            success: 'mdi-check-circle',
            danger: 'mdi-alert-circle',
            warning: 'mdi-alert',
            info: 'mdi-information'
        };

        const iconClass = iconMap[type] || 'mdi-information';

        alertContainer.innerHTML = `
            <div class="d-flex align-items-center">
                <div class="${type}-icon me-3">
                    <i class="mdi ${iconClass}"></i>
                </div>
                <div class="${type}-content">
                    <h6 class="mb-1 fw-bold">${title}</h6>
                    <p class="mb-0">${message}</p>
                </div>
            </div>
            <button type="button" class="btn-close" aria-label="Close"></button>
        `;

        // Insert at the top of the content
        const contentSection = document.querySelector('#content') || document.querySelector('main') || document.body;
        contentSection.insertBefore(alertContainer, contentSection.firstChild);

        // Initialize interactions for the new alert
        const instance = new FlashMessages();
        instance.initInteractions();

        // Auto-hide
        setTimeout(() => {
            instance.hideAlert(alertContainer);
        }, duration);

        return alertContainer;
    }

    // Convenience methods for different alert types
    static success(message, title = 'Berhasil!', duration = 5000) {
        return FlashMessages.show('success', title, message, duration);
    }

    static error(message, title = 'Terjadi Kesalahan!', duration = 7000) {
        return FlashMessages.show('danger', title, message, duration);
    }

    static warning(message, title = 'Peringatan!', duration = 6000) {
        return FlashMessages.show('warning', title, message, duration);
    }

    static info(message, title = 'Informasi', duration = 5000) {
        return FlashMessages.show('info', title, message, duration);
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    new FlashMessages();
});

// Make FlashMessages available globally for AJAX operations
window.FlashMessages = FlashMessages;
