<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Rustic Eats</title>
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
            max-width: 450px;
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
        
        .password-strength {
            height: 4px;
            margin-top: 5px;
            border-radius: 2px;
            transition: all 0.3s;
        }
        
        .strength-weak {
            background-color: #dc3545;
            width: 25%;
        }
        
        .strength-fair {
            background-color: #fd7e14;
            width: 50%;
        }
        
        .strength-good {
            background-color: #ffc107;
            width: 75%;
        }
        
        .strength-strong {
            background-color: #198754;
            width: 100%;
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
        
        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
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
                <h2 class="auth-title">Create Account</h2>
                <p class="auth-subtitle">Join the Rustic Eats community</p>
            </div>
            
            <div class="auth-body">
                <form id="signupForm">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstName" placeholder="John" required>
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" placeholder="Doe" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="signupEmail" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="signupEmail" placeholder="your@email.com" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="signupPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="signupPassword" placeholder="Create a password" required>
                        <div class="form-text">Password must be at least 8 characters long</div>
                        <div id="passwordStrength" class="password-strength"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm your password" required>
                    </div>
                    
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="agreeTerms" required>
                        <label class="form-check-label" for="agreeTerms">
                            I agree to the <a href="#" class="text-primary">Terms of Service</a> and <a href="#" class="text-primary">Privacy Policy</a>
                        </label>
                    </div>
                    
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="newsletter">
                        <label class="form-check-label" for="newsletter">
                            Send me special offers and updates
                        </label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-auth w-100">Create Account</button>
                </form>
                
                <div class="divider">
                    <span class="divider-text">Or sign up with</span>
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
                    <p class="text-muted">Already have an account? 
                        <a href="login.html" class="text-primary">Sign in here</a>
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
        // Signup form submission
        document.getElementById('signupForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const firstName = document.getElementById('firstName').value;
            const lastName = document.getElementById('lastName').value;
            const email = document.getElementById('signupEmail').value;
            const password = document.getElementById('signupPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const agreeTerms = document.getElementById('agreeTerms').checked;
            const newsletter = document.getElementById('newsletter').checked;
            
            // Validation
            if (!firstName || !lastName || !email || !password || !confirmPassword) {
                showAlert('Please fill in all fields', 'danger');
                return;
            }
            
            if (password.length < 8) {
                showAlert('Password must be at least 8 characters long', 'danger');
                return;
            }
            
            if (password !== confirmPassword) {
                showAlert('Passwords do not match', 'danger');
                return;
            }
            
            if (!agreeTerms) {
                showAlert('Please agree to the Terms of Service and Privacy Policy', 'danger');
                return;
            }
            
            // In a real app, you would make an API call here
            simulateSignup(firstName, lastName, email, password, newsletter);
        });
        
        // Password strength indicator
        document.getElementById('signupPassword').addEventListener('input', function() {
            updatePasswordStrength(this.value);
        });
        
        // Social signup buttons
        document.querySelectorAll('.social-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const provider = this.textContent.includes('Google') ? 'Google' : 'Facebook';
                alert('${provider} signup would be implemented here.');
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
            const form = document.getElementById('signupForm');
            form.insertBefore(alert, form.firstChild);
            
            // Auto dismiss after 5 seconds
            setTimeout(() => {
                if (alert.parentNode) {
                    alert.remove();
                }
            }, 5000);
        }
        
        // Update password strength indicator
        function updatePasswordStrength(password) {
            const strengthBar = document.getElementById('passwordStrength');
            if (!strengthBar) return;
            
            let strength = 0;
            let tips = "";
            
            // Check password length
            if (password.length >= 8) {
                strength += 1;
            } else {
                tips += "Make the password at least 8 characters. ";
            }
            
            // Check for mixed case
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) {
                strength += 1;
            } else {
                tips += "Include both lowercase and uppercase letters. ";
            }
            
            // Check for numbers
            if (password.match(/\d/)) {
                strength += 1;
            } else {
                tips += "Include at least one number. ";
            }
            
            // Check for special characters
            if (password.match(/[^a-zA-Z\d]/)) {
                strength += 1;
            } else {
                tips += "Include at least one special character. ";
            }
            
            // Update strength bar
            strengthBar.className = 'password-strength';
            
            if (strength < 2) {
                strengthBar.classList.add('strength-weak');
            } else if (strength === 2) {
                strengthBar.classList.add('strength-fair');
            } else if (strength === 3) {
                strengthBar.classList.add('strength-good');
            } else {
                strengthBar.classList.add('strength-strong');
            }
        }
        
        // Simulate signup process
        function simulateSignup(firstName, lastName, email, password, newsletter) {
            const signupBtn = document.querySelector('#signupForm button[type="submit"]');
            const originalText = signupBtn.innerHTML;
            
            // Show loading state
            signupBtn.innerHTML = '<i class="bi bi-arrow-repeat spinner"></i> Creating Account...';
            signupBtn.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                // In a real app, you would send the data to your server
                
                // For demo, we'll assume successful signup
                const success = true;
                
                if (success) {
                    // Store user data (in a real app, you'd use secure tokens)
                    localStorage.setItem('user', JSON.stringify({
                        email: email,
                        firstName: firstName,
                        lastName: lastName,
                        loggedIn: true,
                        newsletter: newsletter
                    }));
                    
                    // Show success message
                    showAlert('Account created successfully! Redirecting...', 'success');
                    
                    // Redirect to main page after delay
                    setTimeout(() => {
                        window.location.href = 'index.html';
                    }, 1500);
                } else {
                    showAlert('An error occurred. Please try again.', 'danger');
                }
                
                // Reset button
                signupBtn.innerHTML = originalText;
                signupBtn.disabled = false;
            }, 2000);
        }
    </script>
</body>
</html>