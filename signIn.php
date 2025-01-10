
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canteen Management System</title>
    <style>
        body {
            
            font-family: 'Arial', sans-serif;
            background-image: url('chil.jpg');
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: # # #000;;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            width: 400px;
            max-width: 100%;
            padding: 30px;
            box-sizing: border-box;
        }

        h1 {
            font-weight: bold;
            margin: 0 0 20px;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input {
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            border-radius: 20px;
            border: 1px solid #FF4B2B;
            background-color: #FF4B2B;
            color: #FFFFFF;
            font-size: 14px;
            font-weight: bold;
            padding: 12px 20px;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin: 10px 0;
            cursor: pointer;
        }

        button:active {
            transform: scale(0.95);
        }

        .toggle {
            text-align: center;
            margin-top: 20px;
        }

        .toggle a {
            color: #FF4B2B;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container" id="container">
        <div id="signInForm">
            <h1>Sign In</h1>
            <form id="loginForm" action="login.php" method="POST">
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Password" required />
                <button type="submit">Sign In</button>
            </form>
            <div class="toggle">
                <p style="color:black;">Don't have an account? <a href="#" id="showSignUp">Sign Up</a></p>
            </div>
        </div>
        <div id="signUpForm" style="display: none;">
            <h1>Create Account</h1>
            <form id="registerForm" action="register.php" method="POST">
                <input type="text" name="name" placeholder="Name" required />
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Password" required />
                <input type="password" name="cpassword" placeholder="Confirm Password" required />
                <button type="submit">Sign Up</button>
            </form>
            <div class="toggle">
    <p >Already have an account? <a href="#" id="showSignIn">Sign In</a></p>
</div>

        </div>
    </div>
    <script>
        const showSignUp = document.getElementById('showSignUp');
        const showSignIn = document.getElementById('showSignIn');
        const signInForm = document.getElementById('signInForm');
        const signUpForm = document.getElementById('signUpForm');

        showSignUp.addEventListener('click', () => {
            signInForm.style.display = 'none';
            signUpForm.style.display = 'block';
        });

        showSignIn.addEventListener('click', () => {
            signUpForm.style.display = 'none';
            signInForm.style.display = 'block';
        });
    </script>
</body>
</html>
