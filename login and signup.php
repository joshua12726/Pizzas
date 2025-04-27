<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login and signup.css">
    <title>Pizzeria Delight - Login / Sign Up</title>
    <style>
        .input-error {
            color: red;
            font-size: 0.85em;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <video class="background-video" autoplay muted loop>
        <source src="VIDEO1.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="container">
        <!-- Login -->
        <div class="form-container login-form" id="login-form-container">
            <h1>Welcome back!</h1>
            <form id="login-form" method="POST" action="javascript:void(0)">
                <div class="form-group">
                    <label for="login-username">Username</label>
                    <input type="text" id="login-username" name="username" placeholder="Enter your username" required>
                    <div id="login-username-error" class="input-error"></div>
                </div>
                <div class="form-group">
                    <label for="login-password">Password</label>
                    <input type="password" id="login-password" name="password" placeholder="Enter your password" required>
                    <div id="login-password-error" class="input-error"></div>
                    <div class="forgot-password">
                        <a href="#" onclick="showForgotPasswordForm()">Forgot password?</a>
                    </div>
                </div>
                <button type="submit" class="action-button" onclick="loginUser()">Login</button>
                <div class="toggle-link">
                    Don't have an account? <a href="#" onclick="toggleForm('signup')">Sign up</a>
                </div>
            </form>
        </div>

        <!-- Forgot Password -->
        <div class="form-container login-form" id="forgot-password-form">
            <h1>Reset Your Password</h1>
            <form id="reset-password-form" method="POST" action="javascript:void(0)">
                <div class="form-group">
                    <label for="reset-email">Email Address</label>
                    <input type="email" id="reset-email" name="reset-email" placeholder="Enter your email" required>
                </div>
                <button type="submit" class="action-button" onclick="verifyEmail()">Send Reset Link</button>
                <div class="toggle-link">
                    Remember your password? <a href="#" onclick="showLoginForm()">Sign in</a>
                </div>
            </form>
        </div>

        <!-- New Password -->
        <div class="form-container login-form" id="new-password-form">
            <h1>Set New Password</h1>
            <form id="new-password-form-container" method="POST" action="javascript:void(0)">
                <div class="form-group">
                    <label for="new-password">New Password</label>
                    <input type="password" id="new-password" name="new-password" placeholder="Enter your new password" required>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your new password" required>
                </div>
                <button type="submit" class="action-button" onclick="updatePassword()">Update Password</button>
                <div class="toggle-link">
                    Remember your password? <a href="#" onclick="showLoginForm()">Sign in</a>
                </div>
            </form>
        </div>

        <!-- Sign Up -->
        <div class="form-container signup-form" id="signup-form-container">
            <h1>Get Started Now</h1>
            <form id="signup-form" method="POST" onsubmit="signupUser(event)">
                <div class="form-group">
                    <label for="signup-name">Name</label>
                    <input type="text" id="signup-name" name="name" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="signup-email">Email address</label>
                    <input type="email" id="signup-email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="signup-password">Password</label>
                    <input type="password" id="signup-password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="terms-checkbox">
                    <input type="checkbox" id="terms" name="terms">
                    <label for="terms">I agree to the terms & policy</label>
                </div>
                <div id="error-message" class="error-message"></div>
                <button type="submit" class="action-button">Sign Up</button>
                <div class="toggle-link">
                    Have an account? <a href="#" onclick="toggleForm('login')">Sign in</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="custom-modal">
        <div class="modal-content">
            <p id="modal-message"></p>
            <button class="close-button" id="modal-close-button">OK</button>
        </div>
    </div>

    <script>
        let currentEmail = "";

        window.onload = function () {
            document.getElementById('login-form-container').style.display = 'flex';
            document.getElementById('signup-form-container').style.display = 'none';
            document.getElementById('forgot-password-form').style.display = 'none';
            document.getElementById('new-password-form').style.display = 'none';
        };

        function toggleForm(formType) {
            if (formType === 'signup') {
                document.getElementById('login-form-container').style.display = 'none';
                document.getElementById('signup-form-container').style.display = 'flex';
            } else if (formType === 'login') {
                showLoginForm();
            }
        }

        function showForgotPasswordForm() {
            document.getElementById('login-form-container').style.display = 'none';
            document.getElementById('forgot-password-form').style.display = 'block';
            document.getElementById('signup-form-container').style.display = 'none';
        }

        function showLoginForm() {
            document.getElementById('login-form-container').style.display = 'flex';
            document.getElementById('signup-form-container').style.display = 'none';
            document.getElementById('forgot-password-form').style.display = 'none';
            document.getElementById('new-password-form').style.display = 'none';
        }

        function showModal(message, callback) {
            document.getElementById('modal-message').innerText = message;
            document.getElementById('custom-modal').style.display = 'flex';
            const closeButton = document.getElementById('modal-close-button');
            const newCloseButton = closeButton.cloneNode(true);
            closeButton.parentNode.replaceChild(newCloseButton, closeButton);
            newCloseButton.addEventListener('click', function () {
                document.getElementById('custom-modal').style.display = 'none';
                if (callback) callback();
            });
        }

        function loginUser() {
            var username = document.getElementById("login-username").value.trim();
            var password = document.getElementById("login-password").value.trim();
            var usernameError = document.getElementById("login-username-error");
            var passwordError = document.getElementById("login-password-error");

            // Clear previous errors
            usernameError.textContent = "";
            passwordError.textContent = "";

            let hasError = false;

            if (!username) {
                usernameError.textContent = "Please enter your username.";
                hasError = true;
            }

            if (!password) {
                passwordError.textContent = "Please enter your password.";
                hasError = true;
            }

            if (hasError) return;

            var users = JSON.parse(localStorage.getItem('users')) || [];
            var user = users.find(u => u.username === username && u.password === password);

            if (user) {
                sessionStorage.setItem('username', username);
                showModal("Welcome back, " + username + "!", function () {
                    window.location.href = "Hompage.php";
                });
            } else {
                passwordError.textContent = "Invalid username or password.";
            }
        }

        function signupUser(event) {
            event.preventDefault();
            var name = document.getElementById("signup-name").value;
            var email = document.getElementById("signup-email").value;
            var password = document.getElementById("signup-password").value;
            var terms = document.getElementById("terms").checked;
            var errorMessage = document.getElementById("error-message");
            errorMessage.innerHTML = "";

            if (!name || !email || !password) {
                errorMessage.innerHTML = "All fields are required.";
                return;
            }

            if (!validateEmail(email)) {
                errorMessage.innerHTML = "Please enter a valid email address.";
                return;
            }

            if (!terms) {
                errorMessage.innerHTML = "You must agree to the terms & policy.";
                return;
            }

            var users = JSON.parse(localStorage.getItem('users')) || [];
            if (users.some(u => u.email === email)) {
                errorMessage.innerHTML = "This email is already registered.";
                return;
            }
            if (users.some(u => u.username === name)) {
                errorMessage.innerHTML = "This username is already taken.";
                return;
            }

            users.push({ username: name, email: email, password: password });
            localStorage.setItem('users', JSON.stringify(users));
            document.getElementById("signup-name").value = '';
            document.getElementById("signup-email").value = '';
            document.getElementById("signup-password").value = '';
            document.getElementById("terms").checked = false;
            showModal("Account created successfully!", function () {
                location.reload();
            });
        }

        function validateEmail(email) {
            var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            return re.test(email);
        }

        function verifyEmail() {
            var email = document.getElementById('reset-email').value;
            var users = JSON.parse(localStorage.getItem('users')) || [];
            var user = users.find(u => u.email === email);
            if (user) {
                currentEmail = email;
                document.getElementById('forgot-password-form').style.display = 'none';
                document.getElementById('new-password-form').style.display = 'block';
            } else {
                showModal("This email is not registered.");
            }
        }

        function updatePassword() {
            var newPassword = document.getElementById('new-password').value;
            var confirmPassword = document.getElementById('confirm-password').value;

            if (newPassword === confirmPassword && newPassword !== "") {
                var users = JSON.parse(localStorage.getItem('users')) || [];
                var userIndex = users.findIndex(u => u.email === currentEmail);
                if (userIndex !== -1) {
                    users[userIndex].password = newPassword;
                    localStorage.setItem('users', JSON.stringify(users));
                    showModal("Password has been updated successfully.", showLoginForm);
                }
            } else {
                showModal("Passwords do not match or are empty.");
            }
        }
    </script>
</body>
</html>
