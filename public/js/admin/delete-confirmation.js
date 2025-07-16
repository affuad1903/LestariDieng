/**
 * Delete Confirmation Modal - JavaScript
 * Handles beautiful and modern delete confirmation popup
 * Created: July 2025
 */

class DeleteConfirmation {
    constructor() {
        this.deleteForm = null;
        this.messages = {
            'legalitas': 'Apakah Anda yakin ingin menghapus data legalitas ini? Tindakan ini tidak dapat dibatalkan.',
            'media sosial': 'Apakah Anda yakin ingin menghapus akun media sosial ini? Tindakan ini tidak dapat dibatalkan.',
            'kontak': 'Apakah Anda yakin ingin menghapus data kontak ini? Tindakan ini tidak dapat dibatalkan.',
            'default': 'Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.'
        };
        this.init();
    }

    init() {
        // Bind confirm delete button event
        const confirmBtn = document.getElementById('confirmDeleteBtn');
        if (confirmBtn) {
            confirmBtn.addEventListener('click', () => this.confirmDelete());
        }

        // Add keyboard event listeners
        document.addEventListener('keydown', (e) => {
            const modal = document.getElementById('deleteConfirmModal');
            if (modal && modal.classList.contains('show')) {
                if (e.key === 'Escape') {
                    this.closeModal();
                } else if (e.key === 'Enter') {
                    this.confirmDelete();
                }
            }
        });
    }

    showDeleteConfirm(type, form) {
        this.deleteForm = form;
        
        // Set message based on type
        const message = this.messages[type] || this.messages['default'];
        const messageElement = document.querySelector('.delete-message');
        
        if (messageElement) {
            messageElement.textContent = message;
        }
        
        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
        modal.show();
        
        // Focus on cancel button for better accessibility
        setTimeout(() => {
            const cancelBtn = document.querySelector('#deleteConfirmModal .btn-secondary');
            if (cancelBtn) {
                cancelBtn.focus();
            }
        }, 300);
    }

    confirmDelete() {
        if (this.deleteForm) {
            // Add loading state to button
            const confirmBtn = document.getElementById('confirmDeleteBtn');
            if (confirmBtn) {
                confirmBtn.innerHTML = '<i class="mdi mdi-loading mdi-spin me-2"></i>Menghapus...';
                confirmBtn.disabled = true;
            }
            
            // Submit form
            this.deleteForm.submit();
        }
    }

    closeModal() {
        const modal = bootstrap.Modal.getInstance(document.getElementById('deleteConfirmModal'));
        if (modal) {
            modal.hide();
        }
    }

    resetModal() {
        this.deleteForm = null;
        
        // Reset button state
        const confirmBtn = document.getElementById('confirmDeleteBtn');
        if (confirmBtn) {
            confirmBtn.innerHTML = '<i class="mdi mdi-delete me-2"></i>Ya, Hapus';
            confirmBtn.disabled = false;
        }
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    window.deleteConfirmation = new DeleteConfirmation();
    
    // Reset modal when hidden
    const modal = document.getElementById('deleteConfirmModal');
    if (modal) {
        modal.addEventListener('hidden.bs.modal', function() {
            window.deleteConfirmation.resetModal();
        });
    }
});

// Global function for backward compatibility
function showDeleteConfirm(type, form) {
    if (window.deleteConfirmation) {
        window.deleteConfirmation.showDeleteConfirm(type, form);
    }
}
