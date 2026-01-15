<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rustic & Organic Restaurant</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- Three.js for 3D animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/loaders/GLTFLoader.min.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#" data-page="home">
                <i class="bi bi-tree-fill me-2"></i>Rustic Eats
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-page="home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-page="menu">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-page="cart">Cart <span class="badge bg-primary" id="cart-count">0</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-page="tracking">Order Tracking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-page="admin">Admin</a>
                    </li>
                    <li class="nav-item logged-out">
        <a class="nav-link" href="login.html">Sign In</a>
    </li>
    <li class="nav-item logged-out">
        <a class="nav-link" href="signup.html">Sign Up</a>
    </li>
    <li class="nav-item dropdown logged-in" style="display: none;">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle me-1"></i> <span class="user-name">User</span>
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="#">Order History</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item logout-btn" href="#">Logout</a></li>
        </ul>
    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Home Page -->
    <section id="home" class="page active">
        <!-- Hero Section -->
        <div class="hero-section">
            <div id="three-canvas"></div>
            <div class="container hero-content">
                <div class="row">
                    <div class="col-lg-8">
                        <h1 class="hero-title">Freshly Made. Naturally Served.</h1>
                        <p class="lead mb-4">Experience the taste of nature with our organic ingredients and rustic cooking methods.</p>
                        <a href="#" class="btn btn-primary btn-lg" data-page="menu">Order Now</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Dishes -->
        <div class="container my-5">
            <h2 class="section-title">Featured Dishes</h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="card-img-top" alt="Fresh Salad">
                        <div class="card-body">
                            <h5 class="card-title">Organic Garden Salad</h5>
                            <p class="card-text">Fresh greens with seasonal vegetables and house dressing.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 text-primary">$12.99</span>
                                <button class="btn btn-sm btn-outline-primary add-to-cart" data-name="Organic Garden Salad" data-price="12.99">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="card-img-top" alt="Wood-Fired Pizza">
                        <div class="card-body">
                            <h5 class="card-title">Wood-Fired Pizza</h5>
                            <p class="card-text">Artisan pizza with organic toppings and homemade sauce.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 text-primary">$16.99</span>
                                <button class="btn btn-sm btn-outline-primary add-to-cart" data-name="Wood-Fired Pizza" data-price="16.99">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1563379926898-05f4575a45d8?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="card-img-top" alt="Grilled Salmon">
                        <div class="card-body">
                            <h5 class="card-title">Grilled Salmon</h5>
                            <p class="card-text">Wild-caught salmon with herbs and lemon butter sauce.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 text-primary">$22.99</span>
                                <button class="btn btn-sm btn-outline-primary add-to-cart" data-name="Grilled Salmon" data-price="22.99">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="https://images.unsplash.com/photo-1488477181946-6428a0291777?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="card-img-top" alt="Berry Dessert">
                        <div class="card-body">
                            <h5 class="card-title">Berry Delight</h5>
                            <p class="card-text">Seasonal berries with honey yogurt and crushed nuts.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 text-primary">$8.99</span>
                                <button class="btn btn-sm btn-outline-primary add-to-cart" data-name="Berry Delight" data-price="8.99">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Reviews -->
        <div class="container my-5">
            <h2 class="section-title">Customer Reviews</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=60" class="rounded-circle mb-3" width="80" height="80" alt="Customer">
                            <h5 class="card-title">Sarah M.</h5>
                            <div class="mb-2">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </div>
                            <p class="card-text">"The food here is absolutely amazing! Everything tastes so fresh and natural."</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=60" class="rounded-circle mb-3" width="80" height="80" alt="Customer">
                            <h5 class="card-title">Michael T.</h5>
                            <div class="mb-2">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-half text-warning"></i>
                            </div>
                            <p class="card-text">"Love the rustic atmosphere and the organic ingredients. Will definitely come back!"</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=60" class="rounded-circle mb-3" width="80" height="80" alt="Customer">
                            <h5 class="card-title">Jessica L.</h5>
                            <div class="mb-2">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </div>
                            <p class="card-text">"The wood-fired pizza is to die for! You can taste the quality in every bite."</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Menu Page -->
    <section id="menu" class="page">
        <div class="container my-5">
            <h2 class="section-title">Our Menu</h2>
            
            <div class="row">
                <!-- Categories -->
                <div class="col-lg-3 mb-4">
                    <div class="menu-category active" data-category="all">All Items</div>
                    <div class="menu-category" data-category="starters">Starters</div>
                    <div class="menu-category" data-category="main">Main Course</div>
                    <div class="menu-category" data-category="desserts">Desserts</div>
                    <div class="menu-category" data-category="drinks">Drinks</div>
                </div>
                
                <!-- Menu Items -->
                <div class="col-lg-9">
                    <div class="row" id="menu-items">
                        <!-- Menu items will be populated by JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cart Page -->
    <section id="cart" class="page">
        <div class="container my-5">
            <h2 class="section-title">Your Cart</h2>
            
            <div class="row">
                <div class="col-lg-8">
                    <div id="cart-items">
                        <!-- Cart items will be populated by JavaScript -->
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Order Summary</h5>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal:</span>
                                <span id="subtotal">$0.00</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Tax (8%):</span>
                                <span id="tax">$0.00</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Delivery:</span>
                                <span>$2.99</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-3">
                                <strong>Total:</strong>
                                <strong id="total">$0.00</strong>
                            </div>
                            <button class="btn btn-primary w-100" data-page="checkout">Proceed to Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Checkout Page -->
    <section id="checkout" class="page">
        <div class="container my-5">
            <h2 class="section-title">Checkout</h2>
            
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Delivery Information</h5>
                            <form id="checkout-form">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" id="phone" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Delivery Address</label>
                                    <textarea class="form-control" id="address" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="note" class="form-label">Delivery Note (Optional)</label>
                                    <textarea class="form-control" id="note" rows="2"></textarea>
                                </div>
                                
                                <h5 class="card-title mt-4">Payment Method</h5>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="payment" id="cash" checked>
                                    <label class="form-check-label" for="cash">
                                        Cash on Delivery
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment" id="online">
                                    <label class="form-check-label" for="online">
                                        Online Payment
                                    </label>
                                </div>
                                
                                <button type="submit" class="btn btn-primary mt-4 w-100" id="place-order">Place Order</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Order Summary</h5>
                            <div id="checkout-summary">
                                <!-- Order summary will be populated by JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Order Tracking Page -->
    <section id="tracking" class="page">
        <div class="container my-5">
            <h2 class="section-title">Order Tracking</h2>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <h4>Order #RS-2023-0012</h4>
                                <p class="text-muted">Estimated delivery: 45 minutes</p>
                            </div>
                            
                            <div class="timeline">
                                <div class="timeline-step active">
                                    <div class="timeline-icon">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                    <div>
                                        <h5>Order Placed</h5>
                                        <p class="text-muted">Your order has been received</p>
                                        <small>10:15 AM</small>
                                    </div>
                                </div>
                                <div class="timeline-step active">
                                    <div class="timeline-icon">
                                        <i class="bi bi-egg-fried"></i>
                                    </div>
                                    <div>
                                        <h5>Preparing</h5>
                                        <p class="text-muted">Our chef is preparing your food</p>
                                        <small>10:20 AM</small>
                                    </div>
                                </div>
                                <div class="timeline-step">
                                    <div class="timeline-icon">
                                        <i class="bi bi-bicycle"></i>
                                    </div>
                                    <div>
                                        <h5>Out for Delivery</h5>
                                        <p class="text-muted">Your order is on the way</p>
                                    </div>
                                </div>
                                <div class="timeline-step">
                                    <div class="timeline-icon">
                                        <i class="bi bi-house-check"></i>
                                    </div>
                                    <div>
                                        <h5>Delivered</h5>
                                        <p class="text-muted">Your order has been delivered</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-4 text-center">
                                <div class="food-3d-container" id="delivery-animation">
                                    <!-- 3D delivery animation will be here -->
                                     </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Admin Dashboard -->
    <section id="admin" class="page">
        <div class="container my-5">
            <h2 class="section-title">Admin Dashboard</h2>
            
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="admin-card text-center">
                        <h3 class="text-primary">12</h3>
                        <p class="text-muted">New Orders</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="admin-card text-center">
                        <h3 class="text-success">8</h3>
                        <p class="text-muted">Preparing</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="admin-card text-center">
                        <h3 class="text-warning">5</h3>
                        <p class="text-muted">Out for Delivery</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="admin-card text-center">
                        <h3 class="text-secondary">42</h3>
                        <p class="text-muted">Completed Today</p>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="admin-card">
                        <h5>Recent Orders</h5>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Items</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#RS-2023-0015</td>
                                        <td>Sarah Johnson</td>
                                        <td>2 items</td>
                                        <td><span class="badge bg-warning">Preparing</span></td>
                                        <td>
                                            <select class="form-select form-select-sm">
                                                <option>Preparing</option>
                                                <option>Out for Delivery</option>
                                                <option>Delivered</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>#RS-2023-0014</td>
                                        <td>Michael Brown</td>
                                        <td>3 items</td>
                                        <td><span class="badge bg-primary">New</span></td>
                                        <td>
                                            <select class="form-select form-select-sm">
                                                <option>New</option>
                                                <option>Preparing</option>
                                                <option>Out for Delivery</option>
                                                <option>Delivered</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>#RS-2023-0013</td>
                                        <td>Emily Davis</td>
                                        <td>1 item</td>
                                        <td><span class="badge bg-success">Out for Delivery</span></td>
                                        <td>
                                            <select class="form-select form-select-sm">
                                                <option>Out for Delivery</option>
                                                <option>Delivered</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="admin-card">
                        <h5>Daily Report</h5>
                        <canvas id="salesChart" width="400" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>Rustic Eats</h5>
                    <p>Fresh ingredients, rustic flavors, and natural goodness in every bite.</p>
                    <div class="social-links">
                        <a href="#" class="me-3"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="me-3"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="me-3"><i class="bi bi-twitter"></i></a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Contact Info</h5>
                    <p><i class="bi bi-geo-alt me-2"></i> 123 Nature Lane, Green Valley</p>
                    <p><i class="bi bi-telephone me-2"></i> (555) 123-4567</p>
                    <p><i class="bi bi-envelope me-2"></i> info@rusticeats.com</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Opening Hours</h5>
                    <p>Monday - Friday: 11am - 10pm</p>
                    <p>Saturday - Sunday: 10am - 11pm</p>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p>&copy; 2023 Rustic Eats. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js for Admin Dashboard -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Custom JavaScript -->
    <script src="script.js"></script>
</body>
</html>