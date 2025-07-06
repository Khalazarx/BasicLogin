<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anre</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<style>
    *{
        font-family: "Montserrat", regular sans-serif;
        font-size: 14px;
        margin: 0;
        padding: 0;
        /* border: 1px solid #000000; Default border to avoid layout shift */
    }

    body {
        background: radial-gradient(circle, #32E1AD 0%, #054A62 90%);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh; /* Full viewport height */
        margin: 0; /* Remove default margin */
        padding: 0; /* Remove default padding */
    }

    li {
        list-style: none;
        margin: 1.5rem 0;
    }
    .register-link a {
        text-decoration: none;
        color: #054A62;
        font-weight: bold;
    }

    .login {
        background-color: #32E1AD;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        padding: 3rem;
        border: 1px solid #ffffffc7;
        border-radius: 10px;
        box-shadow: 10px 15px 7px rgba(0, 0, 0, 0.233);
        width: 300px; /* Fixed width for the login box */
        height: 450px; /* Fixed height for the login box */
    }
    .login h1 { 
        font-size: 2rem;
        text-align: center;
        font-weight: 800;
        margin-bottom: 2rem;
        color: #054A62;
    }
    .login form {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .login .form-group {
        margin-bottom: 15px;
        display: flex;
        flex-direction: column;
    }

    .login label {
        width: 290px;
    }

    .login .form-group label {
        font-weight: bold;
        color: #054A62;
        display: block;
        margin-bottom: 5px;
    }
    .login .form-group input {
        width: 100%;
        padding: 8px;
        border: 1px solid #054A62;
        border-radius: 8px;
        width: 100%;
        box-sizing: border-box; /* Ensures padding is included in width */
    }
    .login button {
        background-color: #054A62;
        font-weight: bold;
        width: 100%;
        border: 1px solid #F5F4F3;
        color: #F5F4F3;
        margin-top: 10px;
        padding: 10px 110px;
        border: none;
        border-radius: 20px;
        cursor: pointer;
    }

    .btn-group {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .register-link {
        margin-top: 10px;
        text-align: center;
    }
    .register-text {
        color: #054A62;
        font-size: 0.85rem;
        margin-top: 20px;
        margin-bottom: 25px;
    }
    .register-link a {
        color: #054A62;
        text-decoration: none;
        font-size: 0.85rem;
    }

    .btn-connect {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 4rem
    }

    .connect-text {
        color: #054A62;
        font-size: 13px;
        font-weight: 600;
        border-bottom: 1px solid #054b6277;
        width: 250px;
        text-align: center;
        padding-bottom: 10px;
        margin-bottom: 15px;
    }

    .btn-google {
        display: inline;
        justify-content: center;
        align-items: center;
        border: 1px solid #054A62;
        background-color: #ffffff;
        border-radius: 33px;
        padding: 9px 40px;
    }

    .btn-google a {
        color: #054A62;
        text-decoration: none;
        font-weight: 600;
        margin-left: 0.5rem;
    }


    @media (max-width: 350px) {
        .login {
            width: 100%; /* Responsive width for smaller screens */
            height: auto; /* Allow height to adjust based on content */
        }
        .login h1 {
            font-size: 1.5rem; /* Smaller font size for smaller screens */
        }
        .login label {
            width: 100%; /* Ensure labels take full width */
            
        }
        .login .form-group input {
            width: 100%; /* Ensure inputs take full width */
        }
        .btn-group {
            width: 100%; /* Ensure button group takes full width */
            font-size: 0.65rem;
        }
    }


</style>
<body>

    <!-- Login Form -->
    <div class="login">
        <h1 class="title">LOGIN</h1>
        <form action="process.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <!-- Submit Button -->
            <div class="btn-group">
                <button type="submit">Login</button>
            </div>

            <!-- Register Link -->
            <div class="register-link">
                <p class="register-text">Don't have an account? <a href="register.html" style="text-decoration: underline;">Sign-up</a></p>
            </div>
            

            <!-- Connect with Google -->
            <div class="btn-connect">
                <div class="connect-text">Or sign in with</div>
                
                <div class="btn-google">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google icon" style="width:20px; height:20px; vertical-align:middle; margin-bottom:2px;"><a href="#">Google</a>
                </div>
            </div>
        </form>
    </div>


</body>
</html>