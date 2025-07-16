/**
 * ===================================
 * DASHBOARD HOME SIMPLE JAVASCRIPT
 * Fungsi: Image modal, preview, stats animations (TANPA dropdown positioning)
 * ===================================
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // ===== IMAGE MODAL FUNCTIONALITY =====
    
    /**
     * Show image in modal
     * @param {string} src - Image source URL
     * @param {string} title - Image title
     */
    window.showImage = function(src, title) {
        const modalImage = document.getElementById('modalImage');
        const modalTitle = document.getElementById('imageModalTitle');
        
        if (modalImage && modalTitle) {
            modalImage.src = src;
            modalTitle.textContent = title;
            
            // Add loading state
            modalImage.style.opacity = '0.5';
            modalImage.onload = function() {
                this.style.opacity = '1';
            };
        }
    };
    
    // ===== WEBSITE PREVIEW FUNCTIONALITY =====
    
    /**
     * Preview website in new tab
     */
    window.previewWebsite = function() {
        // Show loading notification
        showNotification('Membuka preview website...', 'info', 2000);
        
        // Open website in new tab
        setTimeout(() => {
            window.open('/', '_blank');
        }, 500);
    };
    
    // ===== STATS CARD ANIMATIONS =====
    
    function animateStatsNumbers() {
        const statsNumbers = document.querySelectorAll('.stats-content h3');
        
        statsNumbers.forEach(stat => {
            const finalValue = parseInt(stat.textContent) || 0;
            const duration = 2000; // 2 seconds
            const stepTime = 50; // Update every 50ms
            const steps = duration / stepTime;
            const increment = finalValue / steps;
            
            let currentValue = 0;
            const timer = setInterval(() => {
                currentValue += increment;
                if (currentValue >= finalValue) {
                    stat.textContent = finalValue;
                    clearInterval(timer);
                } else {
                    stat.textContent = Math.floor(currentValue);
                }
            }, stepTime);
        });
    }
    
    // Jalankan animasi stats saat page load
    setTimeout(animateStatsNumbers, 500);
    
    // ===== CONTENT GRID INTERACTIONS =====
    
    function initContentGridInteractions() {
        const contentItems = document.querySelectorAll('.content-item');
        
        contentItems.forEach(item => {
            // Add ripple effect on click
            item.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.className = 'ripple-effect';
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    }
    
    // Initialize content grid interactions
    initContentGridInteractions();
    
    // ===== IMAGE LAZY LOADING =====
    
    function initImageLazyLoading() {
        const images = document.querySelectorAll('.content-image');
        
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src || img.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });
            
            images.forEach(img => imageObserver.observe(img));
        }
    }
    
    // Initialize lazy loading
    initImageLazyLoading();
    
    // ===== NOTIFICATION HELPER =====
    
    /**
     * Show notification
     * @param {string} message - Notification message
     * @param {string} type - Notification type (success, error, info, warning)
     * @param {number} duration - Duration in milliseconds
     */
    window.showNotification = function(message, type = 'info', duration = 3000) {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        notification.style.top = '20px';
        notification.style.right = '20px';
        notification.style.zIndex = '9999';
        notification.style.minWidth = '300px';
        
        notification.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(notification);
        
        // Auto remove after duration
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, duration);
    };
    
    // ===== QUICK ACTION INTERACTIONS =====
    
    function initQuickActions() {
        const quickActionBtns = document.querySelectorAll('.quick-action-btn');
        
        quickActionBtns.forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px) scale(1.02)';
            });
            
            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    }
    
    // Initialize quick actions
    initQuickActions();
    
    // ===== RESPONSIVE HANDLING =====
    
    function handleResponsiveChanges() {
        const isMobile = window.innerWidth <= 768;
        const statsCards = document.querySelectorAll('.stats-card');
        
        if (isMobile) {
            statsCards.forEach(card => {
                card.style.flexDirection = 'column';
                card.style.textAlign = 'center';
            });
        } else {
            statsCards.forEach(card => {
                card.style.flexDirection = 'row';
                card.style.textAlign = 'left';
            });
        }
    }
    
    // Handle responsive changes
    window.addEventListener('resize', handleResponsiveChanges);
    handleResponsiveChanges(); // Initial call
    
});
