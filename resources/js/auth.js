// auth.js - Shared authentication functions

// Check if user is logged in
function checkAuthStatus() {
    const user = JSON.parse(localStorage.getItem('user') || '{}');
    return user.loggedIn || false;
}

// Get current user
function getCurrentUser() {
    return JSON.parse(localStorage.getItem('user') || '{}');
}

// Logout function
function logout() {
    localStorage.removeItem('user');
    window.location.href = 'login.html';
}

// Protect routes - redirect to login if not authenticated
function requireAuth() {
    if (!checkAuthStatus()) {
        window.location.href = 'login.html';
        return false;
    }
    return true;
}

// Redirect if already logged in
function redirectIfLoggedIn() {
    if (checkAuthStatus()) {
        window.location.href = 'index.html';
    }
}

// Update UI based on login status
function updateAuthUI() {
    const user = getCurrentUser();
    const authElements = document.querySelectorAll('.auth-element');
    
    authElements.forEach(element => {
        if (user.loggedIn) {
            if (element.classList.contains('logged-in')) {
                element.style.display = 'block';
            }
            if (element.classList.contains('logged-out')) {
                element.style.display = 'none';
            }
            if (element.classList.contains('user-name')) {
                element.textContent = user.firstName || 'User';
            }
        } else {
            if (element.classList.contains('logged-in')) {
                element.style.display = 'none';
            }
            if (element.classList.contains('logged-out')) {
                element.style.display = 'block';
            }
        }
    });
}

// Password validation
function validatePassword(password) {
    const minLength = 8;
    const hasUpperCase = /[A-Z]/.test(password);
    const hasLowerCase = /[a-z]/.test(password);
    const hasNumbers = /\d/.test(password);
    const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);
    
    return {
        isValid: password.length >= minLength && hasUpperCase && hasLowerCase && hasNumbers,
        issues: [
            password.length < minLength ?'Password must be at least ${minLength} characters' : null,
            !hasUpperCase ? 'Password must contain at least one uppercase letter' : null,
            !hasLowerCase ? 'Password must contain at least one lowercase letter' : null,
            !hasNumbers ? 'Password must contain at least one number' : null
        ].filter(issue => issue !== null)
    };
}

// Email validation
function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Format validation errors for display
function formatValidationErrors(errors) {
    if (errors.length === 0) return '';
    
    let html = '<ul class="mb-0">';
    errors.forEach(error => {
        html += <li>${error}</li>;
    });
    html += '</ul>';
    
    return html;
}

// Initialize auth functionality when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Check if we're on a page that requires authentication
    if (document.body.classList.contains('require-auth')) {
        requireAuth();
    }
    
    // Redirect if already logged in (for login/signup pages)
    if (document.body.classList.contains('redirect-if-logged-in')) {
        redirectIfLoggedIn();
    }
    
    // Update UI based on auth status
    updateAuthUI();
    
    // Add logout event listeners
    document.querySelectorAll('.logout-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            logout();
        });
    });
});