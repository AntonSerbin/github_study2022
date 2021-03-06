<!DOCTYPE html>
<html>
<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-size: 22px;
    }

    form {
        width: 40%;
        transform: scale(0.8);
    }

    /* Full-width input fields */
    input[type=text], input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
    }

    input[type=text]:focus, input[type=password]:focus {
        background-color: #ddd;
        outline: none;
    }

    hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
    }

    button {
        background-color: #04AA6D;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
    }

    button:hover {
        opacity: 1;
    }

    /* Extra styles for the cancel button */
    .cancelbtn {
        padding: 14px 20px;
        background-color: #f44336;
    }

    /* Float cancel and signup buttons and add an equal width */
    .cancelbtn, .signupbtn {
        float: left;
        width: 50%;
    }

    /* Add padding to container elements */
    .container {
        padding: 16px;
    }

    /* Clear floats */
    .clearfix::after {
        content: "";
        clear: both;
        display: table;
    }

    /* Change styles for cancel button and signup button on extra small screens */
    @media screen and (max-width: 300px) {
        .cancelbtn, .signupbtn {
            width: 100%;
        }
    }
</style>
<body>

<form action="/addNewUser" style="border:1px solid #ccc" method="post">
    <div class="container">
        <h1>Sign Up</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>
        <label for="login"><b>Your Name-Login</b></label>
        <input type="text" placeholder="Enter Name" name="login" required>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required id="password">

        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat" required id="password_confirm"
               oninput="check(this)">

        <script type='text/javascript'>
            function check(input) {
                if (input.value != document.getElementById('password').value) {
                    input.setCustomValidity('Password Must be Matching.');
                } else {
                    // input is valid -- reset the error message
                    input.setCustomValidity('');
                }
            }
        </script>
        <p style="font-size: 0.9rem">By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms
                & Privacy</a>.</p>

        <div class="clearfix">
            <button type="button" class="cancelbtn" onclick="location.href='/login'">Cancel</button>
            <button type="submit" class="signupbtn">Sign Up</button>
        </div>
    </div>
</form>

</body>
</html>
