<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rustic Eats</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <style>
        .auth-container {
            min-height: 100vh;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), 
                        url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .auth-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            overflow: hidden;
            max-width: 400px;
            width: 100%;
        }
        
        .auth-header {
            background-color: var(--primary);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .auth-body {
            padding: 2rem;
        }
        
        .auth-logo {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .auth-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .auth-subtitle {
            opacity: 0.9;
            font-size: 0.9rem;
        }
        
        .form-control {
            border-radius: 8px;
            padding: 12px;
            border: 1px solid #ddd;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(107, 142, 35, 0.15);
        }
        
        .btn-auth {
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }
        
        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #dee2e6;
        }
        
        .divider-text {
            padding: 0 1rem;
            color: #6c757d;
            font-size: 0.875rem;
        }
        
        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            background: white;
            transition: all 0.3s;
            width: 100%;
            margin-bottom: 10px;
        }
        
        .social-btn:hover {
            background-color: #f8f9fa;
        }
        
        .social-btn i {
            margin-right: 8px;
        }
        
        .back-home {
            color: var(--primary);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            margin-top: 1rem;
        }
        
        .back-home:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-logo">
                    <i class="bi bi-tree-fill"></i>
                </div>
                <h2 class="auth-title">Welcome Back</h2>
                <p class="auth-subtitle">Sign in to your Rustic Eats account</p>
            </div>
            
            <div class="auth-body">
                <form id="loginForm">
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="loginEmail" placeholder="your@email.com" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="loginPassword" placeholder="Enter your password" required>
                    </div>
                    
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-auth w-100 mb-3">Sign In</button>
                    
                    <div class="text-center">
                        <a href="#" class="text-muted" id="forgotPassword">Forgot your password?</a>
                    </div>
                </form>
                
                <div class="divider">
                    <span class="divider-text">Or continue with</span>
                </div>
                
                <div class="social-login">
                    <button class="social-btn">
                        <i class="bi bi-google"></i> Continue with Google
                    </button>
                    <button class="social-btn">
                        <i class="bi bi-facebook"></i> Continue with Facebook
                    </button>
                </div>
                
                <div class="text-center mt-4">
                    <p class="text-muted">Don't have an account? 
                        <a href="signup.html" class="text-primary">Sign up here</a>
                    </p>
                </div>
                
                <div class="text-center">
                    <a href="index.html" class="back-home">
                        <i class="bi bi-arrow-left me-1"></i> Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Auth JavaScript -->
    <script src="auth.js"></script>
    <script>
        // Login form submission
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;
            const rememberMe = document.getElementById('rememberMe').checked;
            
            // Simple validation
            if (!email || !password) {
                showAlert('Please fill in all fields', 'danger');
                return;
            }
            
            // In a real app, you would make an API call here
            simulateLogin(email, password, rememberMe);
        });
        
        // Forgot password
        document.getElementById('forgotPassword').addEventListener('click', function(e) {
            e.preventDefault();
            alert('Password reset functionality would be implemented here. In a real app, this would open a password reset form.');
        });
        
        // Social login buttons
        document.querySelectorAll('.social-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const provider = this.textContent.includes('Google') ? 'Google' : 'Facebook';
                alert('${provider} login would be implemented here.');
            });
        });
        
        // Show alert function
        function showAlert(message, type) {
            // Remove any existing alerts
            const existingAlert = document.querySelector('.alert');
            if (existingAlert) {
                existingAlert.remove();
            }
            
            // Create alert element
            const alert = document.createElement('div');
            alert.className = 'alert alert-${type} alert-dismissible fade show';
            alert.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;
            
            // Add to form
            const form = document.getElementById('loginForm');
            form.insertBefore(alert, form.firstChild);
            
            // Auto dismiss after 5 seconds
            setTimeout(() => {
                if (alert.parentNode) {
                    alert.remove();
                }
            }, 5000);
        }
        
        // Simulate login process
        function simulateLogin(email, password, rememberMe) {
            const loginBtn = document.querySelector('#loginForm button[type="submit"]');
            const originalText = loginBtn.innerHTML;
            
            // Show loading state
            loginBtn.innerHTML = '<i class="bi bi-arrow-repeat spinner"></i> Signing In...';
            loginBtn.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                // In a real app, you would check credentials and get a response
                
                // For demo, we'll assume successful login
                const success = true;
                
                if (success) {
                    // Store user data (in a real app, you'd use secure tokens)
                    localStorage.setItem('user', JSON.stringify({
                        email: email,
                        firstName: 'John', // This would come from the server
                        lastName: 'Doe',
                        loggedIn: true
                    }));
                    
                    // Show success message
                    showAlert('Successfully signed in! Redirecting...', 'success');
                    
                    // Redirect to main page after delay
                    setTimeout(() => {
                        window.location.href = 'index.html';
                    }, 1500);
                } else {
                    showAlert('Invalid email or password', 'danger');
                }
                
                // Reset button
                loginBtn.innerHTML = originalText;
                loginBtn.disabled = false;
            }, 1500);
        }
    </script>
</body>
</html>