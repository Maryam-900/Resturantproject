import './bootstrap';
// Page Navigation
document.querySelectorAll('[data-page]').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const targetPage = this.getAttribute('data-page');
        
        // Hide all pages
        document.querySelectorAll('.page').forEach(page => {
            page.classList.remove('active');
        });
        
        // Show target page
        document.getElementById(targetPage).classList.add('active');
        
        // Add fade-in animation
        document.getElementById(targetPage).classList.add('fade-in');
        setTimeout(() => {
            document.getElementById(targetPage).classList.remove('fade-in');
        }, 500);
        
        // If going to cart page, update cart display
        if (targetPage === 'cart') {
            updateCartDisplay();
        }
        
        // If going to checkout page, update checkout summary
        if (targetPage === 'checkout') {
            updateCheckoutSummary();
        }
    });
});

// Cart functionality
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// Add to cart buttons
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('add-to-cart')) {
        const name = e.target.getAttribute('data-name');
        const price = parseFloat(e.target.getAttribute('data-price'));
        
        // Check if item already in cart
        const existingItem = cart.find(item => item.name === name);
        
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({
                name: name,
                price: price,
                quantity: 1
            });
        }
        
        // Save to localStorage
        localStorage.setItem('cart', JSON.stringify(cart));
        
        // Update cart count
        updateCartCount();
        
        // Show confirmation
        const btn = e.target;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-check-lg"></i> Added';
        btn.classList.add('btn-success');
        btn.classList.remove('btn-outline-primary');
        
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.classList.remove('btn-success');
            btn.classList.add('btn-outline-primary');
        }, 1500);
    }
});

// Update cart count in navbar
function updateCartCount() {
    const count = cart.reduce((total, item) => total + item.quantity, 0);
    document.getElementById('cart-count').textContent = count;
}

// Update cart display on cart page
function updateCartDisplay() {
    const cartItems = document.getElementById('cart-items');
    const subtotalEl = document.getElementById('subtotal');
    const taxEl = document.getElementById('tax');
    const totalEl = document.getElementById('total');
    
    if (cart.length === 0) {
        cartItems.innerHTML = '<div class="text-center py-5"><h5>Your cart is empty</h5><p>Add some delicious items from our menu!</p></div>';
        subtotalEl.textContent = '$0.00';
        taxEl.textContent = '$0.00';
        totalEl.textContent = '$0.00';
        return;
    }
    
    let subtotal = 0;
    let html = '';
    
    cart.forEach((item, index) => {
        const itemTotal = item.price * item.quantity;
        subtotal += itemTotal;
        
        html += `
        <div class="cart-item">
            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=60" class="cart-item-img" alt="${item.name}">
            <div class="flex-grow-1">
                <h6>${item.name}</h6>
                <p class="text-muted">$${item.price.toFixed(2)}</p>
            </div>
            <div class="d-flex align-items-center">
                <div class="quantity-btn me-2" onclick="updateQuantity(${index}, -1)">-</div>
                <span class="mx-2">${item.quantity}</span>
                <div class="quantity-btn ms-2" onclick="updateQuantity(${index}, 1)">+</div>
                <span class="ms-3 fw-bold">$${itemTotal.toFixed(2)}</span>
                <button class="btn btn-sm btn-outline-danger ms-3" onclick="removeFromCart(${index})">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
        `;
    });
    
    cartItems.innerHTML = html;
    
    const tax = subtotal * 0.08;
    const delivery = 2.99;
    const total = subtotal + tax + delivery;
    
    subtotalEl.textContent = '$${subtotal.toFixed(2)}';
    taxEl.textContent = '$${tax.toFixed(2)}';
    totalEl.textContent = '$${total.toFixed(2)}';
}

// Update item quantity in cart
function updateQuantity(index, change) {
    cart[index].quantity += change;
    
    if (cart[index].quantity <= 0) {
        cart.splice(index, 1);
    }
    
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
    updateCartDisplay();
}

// Remove item from cart
function removeFromCart(index) {
    cart.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
    updateCartDisplay();
}

// Update checkout summary
function updateCheckoutSummary() {
    const checkoutSummary = document.getElementById('checkout-summary');
    
    if (cart.length === 0) {
        checkoutSummary.innerHTML = '<p>Your cart is empty</p>';
        return;
    }
    
    let html = '';
    let subtotal = 0;
    
    cart.forEach(item => {
        const itemTotal = item.price * item.quantity;
        subtotal += itemTotal;
        
        html += `
        <div class="d-flex justify-content-between mb-2">
            <span>${item.name} x${item.quantity}</span>
            <span>$${itemTotal.toFixed(2)}</span>
        </div>
        `;
    });
    
    const tax = subtotal * 0.08;
    const delivery = 2.99;
    const total = subtotal + tax + delivery;
    
    html += `
    <hr>
    <div class="d-flex justify-content-between mb-1">
        <span>Subtotal:</span>
        <span>$${subtotal.toFixed(2)}</span>
    </div>
    <div class="d-flex justify-content-between mb-1">
        <span>Tax (8%):</span>
        <span>$${tax.toFixed(2)}</span>
    </div>
    <div class="d-flex justify-content-between mb-2">
        <span>Delivery:</span>
        <span>$${delivery.toFixed(2)}</span>
    </div>
    <div class="d-flex justify-content-between fw-bold">
        <span>Total:</span>
        <span>$${total.toFixed(2)}</span>
    </div>
    `;
    
    checkoutSummary.innerHTML = html;
}

// Place order
document.getElementById('checkout-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // In a real app, you would send the order to a server here
    const placeOrderBtn = document.getElementById('place-order');
    const originalText = placeOrderBtn.innerHTML;
    
    placeOrderBtn.innerHTML = '<i class="bi bi-arrow-repeat spinner"></i> Placing Order...';
    placeOrderBtn.disabled = true;
    
    // Simulate API call
    setTimeout(() => {
        // Clear cart
        cart = [];
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartCount();
        
        // Show success message
        alert('Your order has been placed successfully! Order #RS-2023-0016');
        
        // Redirect to tracking page
        document.querySelectorAll('.page').forEach(page => {
            page.classList.remove('active');
        });
        document.getElementById('tracking').classList.add('active');
        
        // Reset button
        placeOrderBtn.innerHTML = originalText;
        placeOrderBtn.disabled = false;
    }, 2000);
});

// Menu filtering
document.querySelectorAll('.menu-category').forEach(category => {
    category.addEventListener('click', function() {
        // Remove active class from all categories
        document.querySelectorAll('.menu-category').forEach(cat => {
            cat.classList.remove('active');
        });
        
        // Add active class to clicked category
        this.classList.add('active');
        
        // Filter menu items
        const categoryName = this.getAttribute('data-category');
        filterMenuItems(categoryName);
    });
});

// Menu items data
const menuItems = [
    { name: 'Bruschetta', price: 8.99, category: 'starters', image: 'https://images.unsplash.com/photo-1572695157366-5e585ab2b69f?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' },
    { name: 'Caprese Salad', price: 10.99, category: 'starters', image: 'https://images.unsplash.com/photo-1563379926898-05f4575a45d8?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' },
    { name: 'Grilled Salmon', price: 22.99, category: 'main', image: 'https://images.unsplash.com/photo-1467003909585-2f8a72700288?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' },
    { name: 'Wood-Fired Pizza', price: 16.99, category: 'main', image: 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' },
    { name: 'Mushroom Risotto', price: 18.99, category: 'main', image: 'https://images.unsplash.com/photo-1476124369491-e7addf5db371?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' },
    { name: 'Berry Delight', price: 8.99, category: 'desserts', image: 'https://images.unsplash.com/photo-1488477181946-6428a0291777?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' },
    { name: 'Chocolate Lava Cake', price: 9.99, category: 'desserts', image: 'https://images.unsplash.com/photo-1563729784474-d77dbb933a9e?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' },
    { name: 'Fresh Lemonade', price: 4.99, category: 'drinks', image: 'https://images.unsplash.com/photo-1621506289937-a8e4df240d0b?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' },
    { name: 'Organic Coffee', price: 3.99, category: 'drinks', image: 'https://images.unsplash.com/photo-1447933601403-0c6688de566e?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' }
];

// Filter menu items
function filterMenuItems(category) {
    const menuItemsContainer = document.getElementById('menu-items');
    let html = '';
    
    const filteredItems = category === 'all' 
        ? menuItems 
        : menuItems.filter(item => item.category === category);
    
    filteredItems.forEach(item => {
        html += `
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card">
                <img src="${item.image}" class="card-img-top" alt="${item.name}">
                <div class="card-body">
                    <h5 class="card-title">${item.name}</h5>
                    <p class="card-text">Delicious ${item.name.toLowerCase()} made with fresh, organic ingredients.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="h5 text-primary">$${item.price.toFixed(2)}</span>
                        <button class="btn btn-sm btn-outline-primary add-to-cart" data-name="${item.name}" data-price="${item.price}">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
        `;
    });
    
    menuItemsContainer.innerHTML = html;
}

// Initialize menu
filterMenuItems('all');

// Initialize cart count
updateCartCount();

// 3D Animation with Three.js
function initThreeJS() {
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    const renderer = new THREE.WebGLRenderer({ alpha: true });
    renderer.setSize(window.innerWidth, window.innerHeight);
    document.getElementById('three-canvas').appendChild(renderer.domElement);
    
    // Add ambient light
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.6);
    scene.add(ambientLight);
    
    // Add directional light
    const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
    directionalLight.position.set(10, 20, 5);
    scene.add(directionalLight);
    
    // Create a simple 3D food object (plate with food)
    const plateGeometry = new THREE.CylinderGeometry(5, 5, 1, 32);
    const plateMaterial = new THREE.MeshLambertMaterial({ color: 0xffffff });
    const plate = new THREE.Mesh(plateGeometry, plateMaterial);
    plate.position.y = -2;
    scene.add(plate);
    
    // Create food items on the plate
    const foodGeometry = new THREE.SphereGeometry(2, 16, 16);
    const foodMaterial = new THREE.MeshLambertMaterial({ color: 0x6B8E23 });
    const food = new THREE.Mesh(foodGeometry, foodMaterial);
    food.position.y = 0;
    scene.add(food);
    
    // Position camera
    camera.position.z = 15;
    
    // Animation loop
    function animate() {
        requestAnimationFrame(animate);
        
        // Rotate the plate and food
        plate.rotation.y += 0.01;
        food.rotation.y += 0.01;
        
        renderer.render(scene, camera);
    }
    
    animate();
    
    // Handle window resize
    window.addEventListener('resize', function() {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    });
}

// Initialize 3D animation when page loads
window.addEventListener('load', function() {
    // Only initialize on home page
    if (document.getElementById('home').classList.contains('active')) {
        initThreeJS();
    }
});

// Initialize chart for admin dashboard
function initChart() {
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Orders',
                data: [12, 19, 15, 17, 22, 28, 24],
                backgroundColor: '#6B8E23',
                borderColor: '#5a7a1d',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

// Initialize chart when admin page is loaded
document.querySelector('[data-page="admin"]').addEventListener('click', function() {
    setTimeout(initChart, 500);
});