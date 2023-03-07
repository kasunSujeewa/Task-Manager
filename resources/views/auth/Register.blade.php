<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid gray;
            padding: 20px;
            max-width: 400px;
            margin: 10% auto;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type=text],
        input[type=email],
        input[type=password] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        input[type=submit]:hover {
            background-color: #3e8e41;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .success {
            color: green;
            font-size: 14px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body class="antialiased">
    <form action="/register" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required>
        <div id="name-error" class="error"></div>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        <div id="email-error" class="error"></div>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        <div id="password-error" class="error"></div>

        <label for="confirm-password">Confirm Password</label>
        <input type="password" id="confirm-password" name="confirm-password" required>
        <div id="confirm-password-error" class="error"></div>

        <input type="submit" value="Register">
        <hr>
        <a href="login">Login</a>
    </form>

    <script>
        // Get the form and input fields
            const form = document.querySelector('form');
            const nameInput = document.getElementById('name');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirm-password');
    
            // Add event listeners to the input fields
            nameInput.addEventListener('input', validateName);
            emailInput.addEventListener('input', validateEmail);
            passwordInput.addEventListener('input', validatePassword);
            confirmPasswordInput.addEventListener('input', validateConfirmPassword);
    
            // Validate the name field
            function validateName() {
                const nameError = document.getElementById('name-error');
                if (nameInput.value.trim() === '') {
                    nameError.textContent = 'Name is required';
                } else {
                    nameError.textContent = '';
                }
            }
    
            // Validate the email field
            function validateEmail() {
                const emailError = document.getElementById('email-error');
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailInput.value)) {
                    emailError.textContent = 'Please enter a valid email';
                } else {
                    emailError.textContent = '';
                }
            }

            // Validate password
            function validatePassword() {
                const passwordError = document.getElementById('password-error');
            if (password.value === "") {
                passwordError.textContent = "Password is required";
                passwordError.style.display = "block";
                return false;
            } else if (!passwordPattern.test(password.value)) {
                passwordError.textContent = "Password must contain at least 8 characters, including at least one uppercase letter, one lowercase letter, and one number";
                passwordError.style.display = "block";
                return false;
            } else {
                passwordError.style.display = "none";
                return true;
            }
            }

            // Validate confirm password
            function validateConfirmPassword() {
                const confirmPasswordError = document.getElementById('confirm-password-error');
            if (confirmPassword.value === "") {
                confirmPasswordError.textContent = "Confirm Password is required";
                confirmPasswordError.style.display = "block";
                return false;
            } else if (confirmPassword.value !== password.value) {
                confirmPasswordError.textContent = "Passwords do not match";
                confirmPasswordError.style.display = "block";
                return false;
            }
            else{
                return true;
            }
        }
    </script>

</body>

</html>