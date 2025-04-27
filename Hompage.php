<?php
$menuItems = [
    [
        'name' => 'BACON Pizza',
        'price' => 150,
        'image' => 'bacon.jpg'
    ],
    [
        'name' => 'HOT Pizza',
        'price' => 190,
        'image' => 'Pizzas namo.jpg'
    ],
    [
        'name' => 'HOTDOG Pizza',
        'price' => 140,
        'image' => 'Pizzas nila.jpg'
    ],
    [
        'name' => 'Margherita Pizza',
        'price' => 120,
        'image' => 'margherita.jpeg'
    ],
    [
        'name' => 'Pepperoni Pizza',
        'price' => 140,
        'image' => 'peperoni.jpeg'
    ],
    [
        'name' => 'Meat Feast Pizza',
        'price' => 160,
        'image' => 'meat pizza.jpeg'
    ]
];
$drinkItems = [
    [
        'name' => 'Coca-Cola',
        'price' => 50,
        'image' => 'coke.jpg'
    ],
    [
        'name' => 'Pepsi',
        'price' => 50,
        'image' => 'pepsi.jpg'
    ],
    [
        'name' => 'Sprite',
        'price' => 45,
        'image' => 'sprite.jpg'
    ],
    [
        'name' => 'Fanta',
        'price' => 45,
        'image' => 'fanta.png'
    ],
];

$bestSellerItems = [
    [
        'name' => 'pizza with drinks',
        'price' => 1600,
        'image' => 'pizza with drinks.jpg'
    ],
    [
        'name' => 'pizza with pineapple',
        'price' => 1400,
        'image' => 'pizza with pineapple.jpg'
    ],
    [
        'name' => 'overload pizza toppings',
        'price' => 1500,
        'image' => 'overload pizza toppings.jpg'
    ]
];

session_start();


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $itemName = $_POST['name'];
    $itemPrice = $_POST['price'];
    $_SESSION['cart'][] = ['name' => $itemName, 'price' => $itemPrice];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzeria - Home</title>
    <link rel="stylesheet" href="../css/hompage.css">
    <style>
        body, h1, h2, h3, p {
            color: #333 !important;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(145deg, #f4f6f9, #e8edf5);
            color: #2c3e50;
            font-size: 16px;
            line-height: 1.6;
            font-weight: 400;
        }

        /* Header */
        header {
            position: sticky;
            top: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 40px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            z-index: 999;
            border-radius: 0 0 20px 20px;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            width: 40px;
            height: auto;
            object-fit: cover;
            margin-right: 12px;
        }

        .logo h1 {
            font-size: 28px;
            color: black;
            font-weight: 700;
            letter-spacing: 1px;
        }

        nav ul {
            display: flex;
            list-style: none;
        }

        nav ul li {
            margin-left: 25px;
        }

        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            padding: 10px 20px;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        nav ul li a:hover {
            background-color: #fdecea;
            color: #e74c3c;
        }

        .cart-link {
            position: relative;
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -10px;
            background: #e74c3c;
            color: white;
            font-size: 14px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Hero Section */
        .hero {
            height: 420px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            padding: 0 20px;
            text-align: center;
            border-radius: 0 0 20px 20px;
            position: relative;
            z-index: 1;
        }

        .hero h2 {
            font-size: 50px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #fff;
        }

        /* Menu Section */
        .menu-section {
            padding: 60px 40px;
            background: url('menu.jpg') no-repeat center center/cover;
            background-attachment: fixed;
            color: #fff;
            position: relative;
        }

        .menu-header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 40px;
        }

        .menu-header img {
            width: 70px;
            height: 70px;
            margin-right: 15px;
            border-radius: 12px;
        }

        .menu-header h2 {
            font-size: 34px;
            color: black;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .menu-tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        .menu-tab {
            padding: 12px 22px;
            margin: 0 10px;
            border-radius: 12px;
            background-color: black;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
            font-size: 16px;
        }

        .menu-tab.active {
            background-color: #e74c3c;
            color: #fff;
        }

        .menu-category {
            display: none;
        }

        .menu-category.active {
            display: block;
        }

        .menu-items {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
        }

        .menu-item {
            width: 260px;
            background: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.06);
            transition: transform 0.3s ease;
        }

        .menu-item:hover {
            transform: translateY(-8px);
        }

        .menu-item img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .menu-item-details {
            padding: 20px;
            text-align: center;
        }

        .menu-item-details h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }

        .menu-item-details p {
            color: #e74c3c;
            font-weight: bold;
            font-size: 16px;
        }

        .add-to-cart {
            margin-top: 15px;
            padding: 12px 25px;
            background: linear-gradient(to right, #e74c3c, #ff6f61);
            color: white;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
            font-size: 16px;
        }

        .add-to-cart:hover {
            background: linear-gradient(to right, #c0392b, #ff4b4b);
        }

        /* About & Contact */
        section {
            padding: 60px 40px;
            text-align: center;
            background-color: #fafafa;
            margin: 30px 0;
            border-radius: 15px;
        }

        #about-us h2,
        #contact-us h2 {
            font-size: 32px;
            color: black;
            margin-bottom: 20px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        #about-us {
            background: url('menu.jpg') no-repeat center center/cover;
            background-attachment: fixed;
            color: #fff;
            padding: 60px 40px;
            text-align: center;
            margin: 30px 0;
            border-radius: 15px;
        }

        #contact-us {
            background: url('menu.jpg') no-repeat center center/cover;
            background-attachment: fixed;
            color: black;
            padding: 60px 40px;
            text-align: center;
            margin: 30px 0;
            border-radius: 15px;
        }

        #about-us p,
        #contact-us p {
            font-size: 17px;
            color: black;
            max-width: 800px;
            margin: 0 auto 15px;
        }

        .contact-info {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-top: 20px;
        }

        .contact-info p {
            display: flex;
            align-items: center;
            font-size: 16px;
            color: #333;
        }

        .contact-info img {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0; top: 0;
            width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.4);
            padding-top: 80px;
        }

        .modal-content {
            background: #fff;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            font-size: 20px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .modal-footer {
            text-align: right;
        }

        .modal-button {
            padding: 10px 20px;
            border: none;
            margin-left: 10px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            font-size: 16px;
        }

        .modal-button.cancel {
            background-color: #f44336;
            color: white;
        }

        .modal-button:not(.cancel) {
            background-color: #4CAF50;
            color: white;
        }

        /* Profile Modal */
        .profile-info label {
            display: block;
            margin-top: 10px;
            font-weight: 600;
        }

        .profile-info input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .profile-info input:disabled {
            background-color: #f0f0f0;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .menu-items {
                justify-content: space-around;
            }
        }

        @media (max-width: 768px) {
            header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .menu-items {
                flex-direction: column;
                align-items: center;
            }

            .contact-info {
                flex-direction: column;
                gap: 15px;
            }

            .hero h2 {
                font-size: 36px;
            }
        }

        @media (max-width: 480px) {
            .hero h2 {
                font-size: 28px;
            }

            .menu-item {
                width: 90%;
            }

            nav ul {
                flex-direction: column;
                width: 100%;
            }

            nav ul li {
                margin: 10px 0;
            }
        }

        .background-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
            border-radius: 0 0 20px 20px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="hompage 1.jpeg" alt="Pizzeria Logo">
            <h1>Pizzeria</h1>
        </div>
        <nav>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#menu">Menu</a></li>
                <li><a href="#about-us">About Us</a></li>
                <li><a href="#contact-us">Contact Us</a></li>
                <li><a href="cart.php" class="cart-link">Cart <span class="cart-count"><?php echo count($_SESSION['cart']); ?></span></a></li>
                <li><a href="#" id="profile-link">Profile</a></li>
            </ul>
        </nav>
        <div class="user-account">
            <span id="username-display">
                <?php
                if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
                    echo htmlspecialchars($_SESSION['username']);
                } else {
                    echo 'Guest';
                }
                ?>
            </span>
            <a href="login and signup.php" style="text-decoration: none; color: #333; margin-left: 10px;">Logout</a>
        </div>
    </header>

    <section id="home" class="hero">
        <video class="background-video" autoplay muted loop playsinline>
            <source src="hompage.mp4" type="video/mp4">
            Sorry, your browser doesn't support background videos.
        </video>
    </section>

    <section id="menu" class="menu-section">
        <div class="menu-header">
            <img src="hompage 1.jpeg" alt="Menu Icon">
            <h2>Our Menu</h2>
        </div>

        <div class="menu-tabs">
            <div class="menu-tab active" data-tab="pizza">Pizza</div>
            <div class="menu-tab" data-tab="drinks">Drinks</div>
            <div class="menu-tab" data-tab="best-sellers">Overload</div>
        </div>

        <div class="menu-category pizza active" id="pizza">
            <h3>Pizza</h3>
            <div class="menu-items">
                <?php foreach ($menuItems as $item): ?>
                <div class="menu-item">
                    <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                    <div class="menu-item-details">
                        <h3><?php echo $item['name']; ?></h3>
                        <p>Price: ₱<?php echo $item['price']; ?></p>
                        <button class="add-to-cart" data-name="<?php echo $item['name']; ?>" data-price="<?php echo $item['price']; ?>">Add to Cart</button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="menu-category drinks" id="drinks">
            <h3>Drinks</h3>
            <div class="menu-items">
                <?php foreach ($drinkItems as $item): ?>
                <div class="menu-item">
                    <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                    <div class="menu-item-details">
                        <h3><?php echo $item['name']; ?></h3>
                        <p>Price: ₱<?php echo $item['price']; ?></p>
                        <button class="add-to-cart" data-name="<?php echo $item['name']; ?>" data-price="<?php echo $item['price']; ?>">Add to Cart</button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="menu-category best-sellers" id="best-sellers">
            <h3>Overload</h3>
            <div class="menu-items">
                <?php foreach ($bestSellerItems as $item): ?>
                <div class="menu-item">
                    <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                    <div class="menu-item-details">
                        <h3><?php echo $item['name']; ?></h3>
                        <p>Price: ₱<?php echo $item['price']; ?></p>
                        <button class="add-to-cart" data-name="<?php echo $item['name']; ?>" data-price="<?php echo $item['price']; ?>">Add to Cart</button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Confirm Add to Cart</h3>
            </div>
            <p id="modal-message">Are you sure you want to add this item to your cart?</p>
            <div class="modal-footer">
                <button class="modal-button" id="modal-yes">Yes</button>
                <button class="modal-button cancel" id="modal-no">No</button>
            </div>
        </div>
    </div>

    <section id="about-us">
        <h2>About Us</h2>
        <h3>Welcome to Pizzeria! We serve the best pizzas in town, made with fresh ingredients and love!</h3>
    </section>

    <section id="contact-us">
        <h2>Contact Us</h2>
        <h3>If you have any questions, feel free to reach out to us via email or phone.</h3>
        <div class="contact-info">
            <h3> Email: contact@pizzeria.com</h3>
            <h3> Phone: (123) 456-7890</h3>
        </div>
    </section>

    <div id="profileModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>User Profile</h3>
            </div>
            <div class="modal-body">
                <div class="profile-info">
                    <label for="profile-username">Username:</label>
                    <input type="text" id="profile-username" disabled>
                    <label for="profile-email">Email:</label>
                    <input type="email" id="profile-email" disabled>
                    <label for="profile-password">Password:</label>
                    <input type="password" id="profile-password" disabled>
                    <p id="profile-error" style="color: red; font-size: 0.85em; margin-top: 10px; display: none;"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button class="modal-button" id="editProfileBtn">Edit</button>
                <button class="modal-button cancel" id="closeProfileModal">Close</button>
                <button class="modal-button" id="saveProfileBtn" style="display: none;">Save</button>
            </div>
        </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Update cart count
    let cartCount = <?php echo count($_SESSION['cart']); ?>;
    const cartCountElement = document.querySelector('.cart-count');
    if (cartCountElement) {
        cartCountElement.textContent = cartCount;
    }

    // Handle profile data
    const username = sessionStorage.getItem('username');
    const usernameDisplay = document.querySelector('#username-display');
    const profileUsername = document.querySelector('#profile-username');
    const profileEmail = document.querySelector('#profile-email');
    const profilePassword = document.querySelector('#profile-password');
    const profileModal = document.querySelector('#profileModal');
    const profileLink = document.querySelector('#profile-link');
    const editProfileBtn = document.querySelector('#editProfileBtn');
    const saveProfileBtn = document.querySelector('#saveProfileBtn');
    const closeProfileModal = document.querySelector('#closeProfileModal');
    const profileError = document.querySelector('#profile-error');

    if (!username) {
        window.location.href = 'login and signup.php';
    } else {
        const users = JSON.parse(localStorage.getItem('users')) || [];
        const user = users.find(u => u.username === username);

        if (user) {
            profileUsername.value = user.username;
            profileEmail.value = user.email;
            profilePassword.value = user.password;
            if (usernameDisplay) {
                usernameDisplay.textContent = user.username;
            }
        } else {
            profileUsername.value = 'Guest';
            profileEmail.value = 'Not available';
            profilePassword.value = '';
        }
    }

    // Show profile modal
    profileLink.addEventListener('click', function(e) {
        e.preventDefault();
        profileModal.style.display = 'block';
    });

    // Enable editing
    editProfileBtn.addEventListener('click', function() {
        profileUsername.disabled = false;
        profileEmail.disabled = false;
        profilePassword.disabled = false;
        editProfileBtn.style.display = 'none';
        saveProfileBtn.style.display = 'inline-block';
    });

    // Save profile changes
    saveProfileBtn.addEventListener('click', function() {
        const newUsername = profileUsername.value.trim();
        const newEmail = profileEmail.value.trim();
        const newPassword = profilePassword.value.trim();
        const users = JSON.parse(localStorage.getItem('users')) || [];
        const currentUserIndex = users.findIndex(u => u.username === username);

        // Validation
        if (!newUsername || !newEmail || !newPassword) {
            profileError.textContent = 'All fields are required.';
            profileError.style.display = 'block';
            return;
        }

        if (!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/.test(newEmail)) {
            profileError.textContent = 'Please enter a valid email address.';
            profileError.style.display = 'block';
            return;
        }

        if (newUsername !== username && users.some(u => u.username === newUsername)) {
            profileError.textContent = 'This username is already taken.';
            profileError.style.display = 'block';
            return;
        }

        if (newEmail !== users[currentUserIndex].email && users.some(u => u.email === newEmail)) {
            profileError.textContent = 'This email is already registered.';
            profileError.style.display = 'block';
            return;
        }

        // Update user data
        if (currentUserIndex !== -1) {
            users[currentUserIndex].username = newUsername;
            users[currentUserIndex].email = newEmail;
            users[currentUserIndex].password = newPassword;
            localStorage.setItem('users', JSON.stringify(users));
            sessionStorage.setItem('username', newUsername);
            usernameDisplay.textContent = newUsername;
            profileUsername.disabled = true;
            profileEmail.disabled = true;
            profilePassword.disabled = true;
            editProfileBtn.style.display = 'inline-block';
            saveProfileBtn.style.display = 'none';
            profileError.style.display = 'none';
            profileModal.style.display = 'none';
            alert('Profile updated successfully!');
        }
    });

    // Close profile modal
    closeProfileModal.addEventListener('click', function() {
        profileModal.style.display = 'none';
        profileUsername.disabled = true;
        profileEmail.disabled = true;
        profilePassword.disabled = true;
        editProfileBtn.style.display = 'inline-block';
        saveProfileBtn.style.display = 'none';
        profileError.style.display = 'none';
        // Reset fields to original values
        const users = JSON.parse(localStorage.getItem('users')) || [];
        const user = users.find(u => u.username === username);
        if (user) {
            profileUsername.value = user.username;
            profileEmail.value = user.email;
            profilePassword.value = user.password;
        }
    });

    // Close modal if clicked outside
    window.addEventListener('click', function(event) {
        if (event.target === profileModal) {
            profileModal.style.display = 'none';
            profileUsername.disabled = true;
            profileEmail.disabled = true;
            profilePassword.disabled = true;
            editProfileBtn.style.display = 'inline-block';
            saveProfileBtn.style.display = 'none';
            profileError.style.display = 'none';
            // Reset fields to original values
            const users = JSON.parse(localStorage.getItem('users')) || [];
            const user = users.find(u => u.username === username);
            if (user) {
                profileUsername.value = user.username;
                profileEmail.value = user.email;
                profilePassword.value = user.password;
            }
        }
    });

    // Modal for Confirming Add to Cart
    const modal = document.getElementById('confirmModal');
    const modalYes = document.getElementById('modal-yes');
    const modalNo = document.getElementById('modal-no');

    let currentItem = {};

    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function() {
            const itemName = this.getAttribute('data-name');
            const itemPrice = this.getAttribute('data-price');
            currentItem = { name: itemName, price: itemPrice };
            document.getElementById('modal-message').textContent = `Are you sure you want to add ${itemName} to your cart?`;
            modal.style.display = 'block';
        });
    });

    modalYes.addEventListener('click', function() {
        fetch('', {
            method: 'POST',
            body: new URLSearchParams({
                'add_to_cart': true,
                'name': currentItem.name,
                'price': currentItem.price
            })
        }).then(response => response.text())
          .then(() => {
              cartCount++;
              cartCountElement.textContent = cartCount;
              modal.style.display = 'none';
          });
    });

    modalNo.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Tab Navigation for Menu Sections
    const tabs = document.querySelectorAll('.menu-tab');
    const categories = document.querySelectorAll('.menu-category');

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            categories.forEach(category => category.classList.remove('active'));
            document.querySelector(`#${targetTab}`).classList.add('active');
        });
    });
});
    </script>
</body>
</html>