/**
 * Paket Show Page JavaScript
 * Handles toggle functionality for collapsible sections
 * Enhanced with smooth animations and better UX
 */

document.addEventListener('DOMContentLoaded', function() {
    const toggleButtons = document.querySelectorAll('.toggle-btn');
    
    // Initialize toggle functionality
    function initializeToggles() {
        toggleButtons.forEach(function(button, index) {
            const content = button.nextElementSibling;
            const icon = button.querySelector('.toggle-icon');
            
            // Set initial state
            content.style.maxHeight = '0px';
            content.style.opacity = '0';
            content.style.padding = '0 1rem';
            content.style.overflow = 'hidden';
            content.style.transition = 'all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            
            if (icon) {
                icon.style.transition = 'transform 0.3s ease-in-out';
                icon.style.transform = 'rotate(0deg)';
            }
            
            // Add click event listener
            button.addEventListener('click', function() {
                toggleSection(this, content, icon);
            });
        });
    }
    
    // Toggle section function
    function toggleSection(button, content, icon) {
        const isOpen = button.classList.contains('active');
        
        if (isOpen) {
            // Close section
            content.style.maxHeight = '0px';
            content.style.opacity = '0';
            content.style.padding = '0 1rem';
            if (icon) icon.style.transform = 'rotate(0deg)';
            button.classList.remove('active');
        } else {
            // Open section
            content.style.maxHeight = content.scrollHeight + 20 + 'px';
            content.style.opacity = '1';
            content.style.padding = '1rem';
            if (icon) icon.style.transform = 'rotate(180deg)';
            button.classList.add('active');
        }
    }
    
    // Expand all sections function
    function expandAllSections() {
        toggleButtons.forEach(function(button) {
            const content = button.nextElementSibling;
            const icon = button.querySelector('.toggle-icon');
            
            if (!button.classList.contains('active')) {
                toggleSection(button, content, icon);
            }
        });
    }
    
    // Collapse all sections function
    function collapseAllSections() {
        toggleButtons.forEach(function(button) {
            const content = button.nextElementSibling;
            const icon = button.querySelector('.toggle-icon');
            
            if (button.classList.contains('active')) {
                toggleSection(button, content, icon);
            }
        });
    }
    
    // Add keyboard support
    toggleButtons.forEach(function(button) {
        button.setAttribute('tabindex', '0');
        button.setAttribute('role', 'button');
        button.setAttribute('aria-expanded', 'false');
        
        button.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                button.click();
            }
        });
        
        // Update aria-expanded when toggled
        button.addEventListener('click', function() {
            const isExpanded = this.classList.contains('active');
            this.setAttribute('aria-expanded', isExpanded.toString());
        });
    });
    
    // Add smooth scroll to sections when opened
    function smoothScrollToSection(element) {
        setTimeout(() => {
            element.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest'
            });
        }, 200);
    }
    
    // Handle window resize
    function handleResize() {
        toggleButtons.forEach(function(button) {
            const content = button.nextElementSibling;
            if (button.classList.contains('active')) {
                content.style.maxHeight = content.scrollHeight + 20 + 'px';
            }
        });
    }
    
    // Initialize everything
    initializeToggles();
    
    // Add resize listener
    window.addEventListener('resize', handleResize);
    
    // Expose functions globally if needed
    window.paketShow = {
        expandAll: expandAllSections,
        collapseAll: collapseAllSections
    };
    
    // Add loading animation completion
    document.body.classList.add('page-loaded');
});
