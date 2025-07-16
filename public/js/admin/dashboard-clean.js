/**
 * ===================================
 * DASHBOARD MAIN JAVASCRIPT - RESPONSIVE VERSION
 * Fungsi: Sidebar toggle, mobile handling, responsive design
 * ===================================
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // ===== ELEMENTS =====
    const sidebar = document.getElementById('sidebar');
    const mainWrapper = document.getElementById('mainWrapper');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    
    // ===== MOBILE SIDEBAR FUNCTIONS =====
    function showMobileSidebar() {
        if (window.innerWidth <= 768) {
            sidebar.classList.add('show');
            if (sidebarOverlay) {
                sidebarOverlay.classList.add('show');
            }
            document.body.style.overflow = 'hidden';
        }
    }
    
    function closeMobileSidebar() {
        sidebar.classList.remove('show');
        if (sidebarOverlay) {
            sidebarOverlay.classList.remove('show');
        }
        document.body.style.overflow = '';
    }
    
    // ===== SIDEBAR TOGGLE =====
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            if (window.innerWidth <= 768) {
                // Mobile behavior
                if (sidebar.classList.contains('show')) {
                    closeMobileSidebar();
                } else {
                    showMobileSidebar();
                }
            } else {
                // Desktop behavior
                sidebar.classList.toggle('collapsed');
                mainWrapper.classList.toggle('expanded');
                
                // Save state to localStorage
                const isCollapsed = sidebar.classList.contains('collapsed');
                localStorage.setItem('sidebarCollapsed', isCollapsed);
            }
        });
    }
    
    // ===== SIDEBAR OVERLAY CLICK =====
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeMobileSidebar);
    }
    
    // ===== ESC KEY TO CLOSE MOBILE SIDEBAR =====
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && window.innerWidth <= 768) {
            closeMobileSidebar();
        }
    });
    
    // ===== WINDOW RESIZE HANDLER =====
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            // Desktop mode
            closeMobileSidebar();
            
            // Restore desktop sidebar state
            const savedState = localStorage.getItem('sidebarCollapsed');
            if (savedState === 'true') {
                sidebar.classList.add('collapsed');
                mainWrapper.classList.add('expanded');
            } else {
                sidebar.classList.remove('collapsed');
                mainWrapper.classList.remove('expanded');
            }
        } else {
            // Mobile mode - reset desktop classes
            sidebar.classList.remove('collapsed');
            mainWrapper.classList.remove('expanded');
        }
    });
    
    // ===== RESTORE DESKTOP SIDEBAR STATE =====
    const savedState = localStorage.getItem('sidebarCollapsed');
    if (savedState === 'true' && window.innerWidth > 768) {
        sidebar.classList.add('collapsed');
        mainWrapper.classList.add('expanded');
    }
    
    // ===== AUTO DISMISS ALERTS =====
    function autoDismissAlerts() {
        const alerts = document.querySelectorAll('.alert-dismissible');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                if (alert.parentNode) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            }, 5000);
        });
    }
    
    autoDismissAlerts();
    
    // ===== SMOOTH SCROLLING =====
    function initSmoothScrolling() {
        const links = document.querySelectorAll('a[href^="#"]');
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href !== '#') {
                    const target = document.querySelector(href);
                    if (target) {
                        e.preventDefault();
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });
    }
    
    initSmoothScrolling();
    
    // ===== PAGE LOADING INDICATOR =====
    function showPageLoading() {
        const loader = document.createElement('div');
        loader.id = 'pageLoader';
        loader.innerHTML = `
            <div class="text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="loading-text">Memuat halaman...</div>
            </div>
        `;
        
        document.body.appendChild(loader);
        
        // Hide loader after page load with smooth fade
        window.addEventListener('load', function() {
            setTimeout(() => {
                if (loader.parentNode) {
                    loader.classList.add('fade-out');
                    setTimeout(() => {
                        loader.remove();
                    }, 300);
                }
            }, 500);
        });
        
        // Auto hide after max 5 seconds as fallback
        setTimeout(() => {
            if (loader.parentNode) {
                loader.classList.add('fade-out');
                setTimeout(() => {
                    loader.remove();
                }, 300);
            }
        }, 5000);
    }
    
    // Show loading for navigation links
    const navLinks = document.querySelectorAll('.nav-link[href]:not([href="#"])');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if (!this.href.includes('#')) {
                showPageLoading();
            }
        });
    });
    
    // ===== KEYBOARD SHORTCUTS =====
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + B untuk toggle sidebar
        if ((e.ctrlKey || e.metaKey) && e.key === 'b') {
            e.preventDefault();
            if (sidebarToggle) {
                sidebarToggle.click();
            }
        }
    });
    
    // ===== RESPONSIVE TABLES =====
    function makeTablesResponsive() {
        const tables = document.querySelectorAll('table:not(.table-responsive table)');
        tables.forEach(table => {
            const wrapper = document.createElement('div');
            wrapper.className = 'table-responsive';
            table.parentNode.insertBefore(wrapper, table);
            wrapper.appendChild(table);
        });
    }
    
    makeTablesResponsive();
    
    // ===== TOAST NOTIFICATIONS =====
    window.showNotification = function(message, type = 'info', duration = 3000) {
        const toastContainer = document.getElementById('toastContainer') || createToastContainer();
        
        const toast = document.createElement('div');
        toast.className = `toast align-items-center text-white bg-${type} border-0`;
        toast.setAttribute('role', 'alert');
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;
        
        toastContainer.appendChild(toast);
        
        const bsToast = new bootstrap.Toast(toast, { delay: duration });
        bsToast.show();
        
        toast.addEventListener('hidden.bs.toast', () => {
            toast.remove();
        });
    };
    
    function createToastContainer() {
        const container = document.createElement('div');
        container.id = 'toastContainer';
        container.className = 'toast-container position-fixed top-0 end-0 p-3';
        container.style.zIndex = '9999';
        document.body.appendChild(container);
        return container;
    }
});
