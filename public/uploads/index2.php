<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FarmFresh - Sustainable Agricultural Marketplace</title>
    <style>
        /* CSS Variables */
        :root {
            --custom-green: #1F5233;
            --custom-green-dark: #174026;
            --light-green: #E8F5E9;
            --accent-color: #FF9800;
            --text-color: #333;
            --light-text: #FFF;
            --gray-bg: #f5f5f5;
            --border-radius: 8px;
            --box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            --transition: all 0.3s ease;
        }

        /* Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: #fcfcfc;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: var(--border-radius);
        }

        button {
            cursor: pointer;
            border: none;
            border-radius: var(--border-radius);
            padding: 10px 15px;
            font-weight: 600;
            transition: var(--transition);
        }

        .primary-btn {
            background-color: var(--custom-green);
            color: var(--light-text);
        }

        .primary-btn:hover {
            background-color: var(--custom-green-dark);
        }

        .secondary-btn {
            background-color: var(--accent-color);
            color: var(--light-text);
        }

        .secondary-btn:hover {
            opacity: 0.9;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 0;
        }

        /* Header & Navigation */
        header {
            background-color: var(--light-green);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: var(--box-shadow);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--custom-green);
        }

        .logo span {
            color: var(--accent-color);
        }

        .nav-toggle {
            display: block;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--custom-green);
        }

        nav {
            position: absolute;
            top: 70px;
            left: 0;
            right: 0;
            background-color: var(--light-green);
            height: 0;
            overflow: hidden;
            transition: var(--transition);
        }

        nav.active {
            height: auto;
            padding: 15px 0;
            box-shadow: 0 5px 5px rgba(0,0,0,0.1);
        }

        nav ul {
            list-style: none;
            padding: 0 5%;
        }

        nav li {
            margin-bottom: 15px;
        }

        nav a {
            color: var(--custom-green);
            font-weight: 600;
            font-size: 1.1rem;
            transition: var(--transition);
        }

        nav a:hover {
            color: var(--accent-color);
        }

        .cart-icon {
            position: relative;
            font-size: 1.4rem;
            color: var(--custom-green);
            margin-left: 20px;
            cursor: pointer;
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--accent-color);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: bold;
        }

        /* Hero Section */
        .hero {
            background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('/api/placeholder/1200/600');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 60px 0;
            text-align: center;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 1.1rem;
            margin-bottom: 30px;
        }

        /* Filter Section */
        .filter-section {
            background-color: var(--gray-bg);
            padding: 20px 0;
        }

        .filter-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }

        .filter-label {
            font-weight: 600;
            margin-right: 10px;
        }

        .filter-options {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .filter-btn {
            background-color: white;
            border: 1px solid var(--custom-green);
            color: var(--custom-green);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .filter-btn.active {
            background-color: var(--custom-green);
            color: white;
        }

        .search-box {
            margin-left: auto;
            margin-top: 10px;
            width: 100%;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 10px 15px;
            border-radius: 20px;
            border: 1px solid #ddd;
            font-size: 0.9rem;
        }

        .search-box button {
            position: absolute;
            right: 5px;
            top: 5px;
            background-color: var(--custom-green);
            color: white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }

        /* Products Section */
        .products-section {
            padding: 40px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.8rem;
            color: var(--custom-green);
        }

        .products-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .product-card {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            transition: var(--transition);
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .product-img {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }

        .product-info {
            padding: 15px;
        }

        .product-category {
            color: var(--accent-color);
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .product-title {
            font-size: 1.2rem;
            margin-bottom: 8px;
            color: var(--custom-green-dark);
        }

        .product-price {
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--custom-green);
            margin-bottom: 15px;
        }

        .product-description {
            margin-bottom: 15px;
            font-size: 0.95rem;
            color: #666;
        }

        .product-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .farmer-info {
            font-size: 0.9rem;
            color: #666;
        }

        /* Contact Form */
        .contact-section {
            background-color: var(--light-green);
            padding: 40px 0;
        }

        .contact-form {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: var(--custom-green-dark);
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-family: inherit;
            font-size: 1rem;
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        /* Cart Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 1000;
            overflow-y: auto;
        }

        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 20px;
            width: 90%;
            max-width: 600px;
            border-radius: var(--border-radius);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            position: relative;
        }

        .close-modal {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 1.5rem;
            cursor: pointer;
            color: #aaa;
        }

        .close-modal:hover {
            color: #333;
        }

        .cart-items {
            max-height: 300px;
            overflow-y: auto;
            margin: 20px 0;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .item-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .item-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: var(--border-radius);
        }

        .item-details h4 {
            font-size: 1rem;
            margin-bottom: 5px;
        }

        .item-price {
            color: var(--custom-green);
            font-weight: 600;
        }

        .item-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .quantity-btn {
            background-color: #eee;
            color: #333;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: 700;
        }

        .item-quantity {
            width: 40px;
            text-align: center;
            font-weight: 600;
        }

        .remove-item {
            color: #f44336;
            cursor: pointer;
            font-size: 1.2rem;
        }

        .cart-totals {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .cart-totals .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .cart-totals .final-total {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--custom-green);
        }

        .empty-cart-message {
            text-align: center;
            padding: 20px;
            color: #666;
        }

        .checkout-btn {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            font-size: 1.1rem;
        }

        /* Footer */
        footer {
            background-color: var(--custom-green-dark);
            color: white;
            padding: 30px 0;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .footer-col h3 {
            margin-bottom: 15px;
            font-size: 1.2rem;
        }

        .footer-col p,
        .footer-col a {
            margin-bottom: 10px;
            display: block;
            color: #eee;
        }

        .footer-col a:hover {
            color: var(--accent-color);
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 15px;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            background-color: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: var(--transition);
        }

        .social-icon:hover {
            background-color: var(--accent-color);
        }

        .copyright {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            font-size: 0.9rem;
            color: #aaa;
        }

        /* Responsive Styles */
        @media (min-width: 576px) {
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .search-box {
                width: auto;
                margin-top: 0;
                flex-grow: 1;
                max-width: 300px;
            }
        }

        @media (min-width: 768px) {
            .hero h1 {
                font-size: 3rem;
            }

            .hero p {
                font-size: 1.2rem;
            }

            .nav-toggle {
                display: none;
            }

            nav {
                position: static;
                height: auto;
                overflow: visible;
                padding: 0;
            }

            nav ul {
                display: flex;
                gap: 20px;
                padding: 0;
            }

            nav li {
                margin-bottom: 0;
            }

            .footer-content {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 992px) {
            .products-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .footer-content {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        /* Utilities */
        .text-center {
            text-align: center;
        }

        .mb-2 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Header & Navigation -->
    <header>
        <div class="container header-content">
            <a href="#" class="logo">Farm<span>Fresh</span></a>
            <button class="nav-toggle" id="navToggle">☰</button>
            <nav id="mainNav">
                <ul>
                    <li><a href="#" class="active">Home</a></li>
                    <li><a href="#products">Products</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
            <div class="cart-icon" id="cartIcon">
                🛒
                <span class="cart-count" id="cartCount">0</span>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container hero-content">
            <h1>From Farm to Table, Sustainably</h1>
            <p>Support local farmers and consume fresher, healthier products while reducing your carbon footprint.</p>
            <a href="#products" class="primary-btn">Shop Now</a>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="filter-section">
        <div class="container filter-container">
            <div class="filter-label">Filter by:</div>
            <div class="filter-options">
                <button class="filter-btn active" data-filter="all">All</button>
                <button class="filter-btn" data-filter="vegetables">Vegetables</button>
                <button class="filter-btn" data-filter="fruits">Fruits</button>
                <button class="filter-btn" data-filter="dairy">Dairy</button>
                <button class="filter-btn" data-filter="grains">Grains</button>
            </div>
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search products...">
                <button>🔍</button>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="products-section" id="products">
        <div class="container">
            <h2 class="section-title">Our Products</h2>
            <div class="products-grid" id="productsGrid">
                <!-- Products will be dynamically inserted here -->
            </div>
        </div>
    </section>

    <!-- Contact Form -->
    <section class="contact-section" id="contact">
        <div class="container">
            <h2 class="section-title">Contact a Seller</h2>
            <form class="contact-form" id="contactForm">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Your Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="seller">Select Seller</label>
                    <select id="seller" name="seller" required>
                        <option value="">-- Select a Seller --</option>
                        <option value="john">John's Organic Farm</option>
                        <option value="maria">Maria's Fresh Produce</option>
                        <option value="david">David's Dairy Farm</option>
                        <option value="sarah">Sarah's Grain Collective</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="message">Your Message</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <button type="submit" class="primary-btn">Send Message</button>
            </form>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section" id="about">
        <div class="container">
            <h2 class="section-title">About FarmFresh</h2>
            <p class="text-center mb-2">
                FarmFresh is dedicated to connecting local farmers with consumers, promoting sustainable agriculture practices,
                and reducing the carbon footprint associated with food transportation.
            </p>
            <p class="text-center">
                By supporting local farmers, you're not only getting fresher, healthier products,
                but also helping to build a more sustainable and resilient food system.
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container footer-content">
            <div class="footer-col">
                <h3>FarmFresh</h3>
                <p>Connecting farmers and consumers for a sustainable future.</p>
                <div class="social-links">
                    <a href="#" class="social-icon">f</a>
                    <a href="#" class="social-icon">in</a>
                    <a href="#" class="social-icon">🐦</a>
                    <a href="#" class="social-icon">📸</a>
                </div>
            </div>
            <div class="footer-col">
                <h3>Quick Links</h3>
                <a href="#">Home</a>
                <a href="#products">Products</a>
                <a href="#about">About Us</a>
                <a href="#contact">Contact</a>
            </div>
            <div class="footer-col">
                <h3>Contact Us</h3>
                <p>📧 info@farmfresh.com</p>
                <p>📞 +1 (555) 123-4567</p>
                <p>🏠 123 Farm Road, Green Valley, CA 94123</p>
            </div>
            <div class="footer-col">
                <h3>Newsletter</h3>
                <p>Subscribe to our newsletter for updates on new products and farmers.</p>
                <form>
                    <div class="form-group">
                        <input type="email" placeholder="Your email" required>
                    </div>
                    <button type="submit" class="secondary-btn">Subscribe</button>
                </form>
            </div>
        </div>
        <div class="copyright">
            &copy; 2025 FarmFresh. All rights reserved. Designed for SDG Goals.
        </div>
    </footer>

    <!-- Cart Modal -->
    <div class="modal" id="cartModal">
        <div class="modal-content">
            <span class="close-modal" id="closeModal">&times;</span>
            <h2>Your Shopping Cart</h2>
            <div class="cart-items" id="cartItems">
                <!-- Cart items will be dynamically inserted here -->
                <div class="empty-cart-message" id="emptyCartMessage">
                    Your cart is empty. Start shopping!
                </div>
            </div>
            <div class="cart-totals" id="cartTotals">
                <div class="total-row">
                    <span>Subtotal</span>
                    <span id="cartSubtotal">$0.00</span>
                </div>
                <div class="total-row">
                    <span>Delivery</span>
                    <span>$5.00</span>
                </div>
                <div class="total-row final-total">
                    <span>Total</span>
                    <span id="cartTotal">$0.00</span>
                </div>
            </div>
            <button class="primary-btn checkout-btn" id="checkoutBtn">Proceed to Checkout</button>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Sample Products Data
        const products = [
            {
                id: 1,
                name: "Organic Tomatoes",
                price: 3.99,
                category: "vegetables",
                image: "/api/placeholder/400/300?text=Tomatoes",
                description: "Fresh, locally grown organic tomatoes. Perfect for salads and cooking.",
                farmer: "John's Organic Farm"
            },
            {
                id: 2,
                name: "Fresh Corn",
                price: 2.49,
                category: "vegetables",
                image: "/api/placeholder/400/300?text=Corn",
                description: "Sweet and juicy corn, harvested daily from our sustainable farms.",
                farmer: "Maria's Fresh Produce"
            },
            {
                id: 3,
                name: "Organic Apples",
                price: 4.99,
                category: "fruits",
                image: "/api/placeholder/400/300?text=Apples",
                description: "Crisp and sweet organic apples. Pesticide-free and sustainably grown.",
                farmer: "Green Valley Orchards"
            },
            {
                id: 4,
                name: "Farm Fresh Milk",
                price: 3.49,
                category: "dairy",
                image: "/api/placeholder/400/300?text=Milk",
                description: "Fresh, pasteurized milk from grass-fed cows. No hormones or antibiotics.",
                farmer: "David's Dairy Farm"
            },
            {
                id: 5,
                name: "Organic Brown Rice",
                price: 5.99,
                category: "grains",
                image: "/api/placeholder/400/300?text=Rice",
                description: "Nutritious whole grain brown rice, grown with sustainable farming practices.",
                farmer: "Sarah's Grain Collective"
            },
            {
                id: 6,
                name: "Fresh Strawberries",
                price: 4.29,
                category: "fruits",
                image: "/api/placeholder/400/300?text=Strawberries",
                description: "Sweet and juicy strawberries, picked at peak ripeness for maximum flavor.",
                farmer: "Berry Good Farms"
            },
            {
                id: 7,
                name: "Organic Carrots",
                price: 2.99,
                category: "vegetables",
                image: "/api/placeholder/400/300?text=Carrots",
                description: "Crunchy, sweet organic carrots. Perfect for snacking or cooking.",
                farmer: "John's Organic Farm"
            },
            {
                id: 8,
                name: "Artisanal Cheese",
                price: 7.99,
                category: "dairy",
                image: "/api/placeholder/400/300?text=Cheese",
                description: "Handcrafted artisanal cheese made from the milk of pasture-raised cows.",
                farmer: "David's Dairy Farm"
            }
        ];

        // DOM Elements
        const productsGrid = document.getElementById('productsGrid');
        const filterButtons = document.querySelectorAll('.filter-btn');
        const searchInput = document.getElementById('searchInput');
        const navToggle = document.getElementById('navToggle');
        const mainNav = document.getElementById('mainNav');
        const cartIcon = document.getElementById('cartIcon');
        const cartModal = document.getElementById('cartModal');
        const closeModal = document.getElementById('closeModal');
        const cartItems = document.getElementById('cartItems');
        const emptyCartMessage = document.getElementById('emptyCartMessage');
        const cartSubtotal = document.getElementById('cartSubtotal');
        const cartTotal = document.getElementById('cartTotal');
        const cartCount = document.getElementById('cartCount');
        const checkoutBtn = document.getElementById('checkoutBtn');
        const contactForm = document.getElementById('contactForm');

        // Cart Array
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        // Initialize the page
        document.addEventListener('DOMContentLoaded', () => {
            displayProducts(products);
            updateCartCount();
        });

        // Display Products Function
        function displayProducts(productsArray) {
            productsGrid.innerHTML = '';
            
            if (productsArray.length === 0) {
                productsGrid.innerHTML = '<p class="text-center">No products found matching your criteria.</p>';
                return;
            }
            
            productsArray.forEach(product => {
                const productCard = document.createElement('div');
                productCard.className = 'product-card';
                productCard.innerHTML = `
                    <img src="${product.image}" alt="${product.name}" class="product-img">
                    <div class="product-info">
                        <div class="product-category">${product.category}</div>
                        <h3 class="product-title">${product.name}</h3>
                        <div class="product-price">$${product.price.toFixed(2)}</div>
                        <p class="product-description">${product.description}</p>
                        <div class="product-footer">
                            <div class="farmer-info">By ${product.farmer}</div>
                            <button class="secondary-btn add-to-cart" data-id="${product.id}">Add to Cart</button>
                        </div>
                    </div>
                `;
                productsGrid.appendChild(productCard);
            });

            // Add event listeners to all Add to Cart buttons
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', (e) => {
                    const productId = parseInt(e.target.getAttribute('data-id'));
                    addToCart(productId);
                });
            });
        }

        // Filter Products
        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Update active button
                filterButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                
                const filterValue = button.getAttribute('data-filter');
                
                // Filter products
                let filteredProducts;
                if (filterValue === 'all') {
                    filteredProducts = products;
                } else {
                    filteredProducts = products.filter(product => product.category === filterValue);
                }
                
                // Apply current search as well
                const searchTerm = searchInput.value.toLowerCase().trim();
                if (searchTerm) {
                    filteredProducts = filteredProducts.filter(product => 
                        product.name.toLowerCase().includes(searchTerm) || 
                        product.description.toLowerCase().includes(searchTerm) ||
                        product.farmer.toLowerCase().includes(searchTerm)
                    );
                }
                
                displayProducts(filteredProducts);
            });
        });

        // Search Products
        searchInput.addEventListener('input', () => {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const activeFilter = document.querySelector('.filter-btn.active').getAttribute('