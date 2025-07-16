/**
 * ===================================
 * DASHBOARD MAIN JAVASCRIPT (SIMPLE VERSION)
 * Fungsi: Sidebar toggle, responsive handling, animations
 * TANPA dropdown positioning yang kompleks
 * ===================================
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // ===== SIDEBAR FUNCTIONALITY =====
    const sidebar = document.getElementById('sidebar');
    const mainWrapper = document.getElementById('mainWrapper');
    const sidebarToggle = document.getElementById('sidebarToggle');
    
    // Sidebar Toggle untuk Desktop
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            mainWrapper.classList.toggle('expanded');
            
            // Simpan state di localStorage
            const isCollapsed = sidebar.classList.contains('collapsed');
            localStorage.setItem('sidebarCollapsed', isCollapsed);
        });
    }
    
    // Restore sidebar state dari localStorage
    const savedState = localStorage.getItem('sidebarCollapsed');
    if (savedState === 'true') {
        sidebar.classList.add('collapsed');
        mainWrapper.classList.add('expanded');
    }
    
    // ===== MOBILE SIDEBAR HANDLING =====
    let sidebarOverlay = null;
    
    function createSidebarOverlay() {
        if (!sidebarOverlay) {
            sidebarOverlay = document.createElement('div');
            sidebarOverlay.className = 'sidebar-overlay';
            document.body.appendChild(sidebarOverlay);
            
            // Close sidebar saat overlay diklik
            sidebarOverlay.addEventListener('click', closeMobileSidebar);
        }
    }
    
    function showMobileSidebar() {
        if (window.innerWidth <= 768) {
            createSidebarOverlay();
            sidebar.classList.add('show');
            sidebarOverlay.classList.add('show');
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
    
    // Mobile sidebar toggle
    if (window.innerWidth <= 768 && sidebarToggle) {
        sidebarToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            if (sidebar.classList.contains('show')) {
                closeMobileSidebar();
            } else {
                showMobileSidebar();
            }
        });
    }
    
    // Close sidebar saat resize ke desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            closeMobileSidebar();
            if (sidebarOverlay) {
                sidebarOverlay.remove();
                sidebarOverlay = null;
            }
        }
    });
    
    // ===== AUTO DISMISS ALERTS =====
    function autoDismissAlerts() {
        const alerts = document.querySelectorAll('.alert-dismissible');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000); // Auto dismiss setelah 5 detik
        });
    }
    
    // Jalankan auto dismiss
    autoDismissAlerts();
    
    // ===== NAVIGATION ACTIVE STATE =====
    function updateActiveNavigation() {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.nav-link');
        
        navLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href && currentPath.includes(href.replace(/\//g, ''))) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    }
    
    // Update navigation on page load
    updateActiveNavigation();
    
    // ===== SMOOTH SCROLLING =====
    function initSmoothScrolling() {
        const links = document.querySelectorAll('a[href^="#"]');
        
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }
    
    // Initialize smooth scrolling
    initSmoothScrolling();
    
    // ===== PAGE LOADING INDICATOR =====
    function showPageLoading() {
        const loader = document.createElement('div');
        loader.id = 'pageLoader';
        loader.innerHTML = `
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        `;
        loader.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            z-index: 9999;
            display: flex;
        `;
        
        document.body.appendChild(loader);
        
        // Hide loader after page load
        window.addEventListener('load', function() {
            setTimeout(() => {
                if (loader.parentNode) {
                    loader.remove();
                }
            }, 500);
        });
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
        // Ctrl/Cmd + K untuk toggle sidebar
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            if (sidebarToggle) {
                sidebarToggle.click();
            }
        }
        
        // Escape untuk close mobile sidebar
        if (e.key === 'Escape') {
            closeMobileSidebar();
        }
    });
    
    // ===== PERFORMANCE MONITORING =====
    function logPerformance() {
        if ('performance' in window) {
            window.addEventListener('load', function() {
                setTimeout(() => {
                    const perfData = performance.getEntriesByType('navigation')[0];
                    console.log('Dashboard Performance:', {
                        domContentLoaded: Math.round(perfData.domContentLoadedEventEnd - perfData.fetchStart),
                        load: Math.round(perfData.loadEventEnd - perfData.fetchStart),
                        firstContentfulPaint: Math.round(performance.getEntriesByName('first-contentful-paint')[0]?.startTime || 0)
                    });
                }, 1000);
            });
        }
    }
    
    // Log performance in development
    if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
        logPerformance();
    }
    
});
