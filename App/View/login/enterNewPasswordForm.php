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
    input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
    }

    input[type=password]:focus {
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

<form action="/saveNewPassword" style="border:1px solid #ccc" method="post">
    <div class="container">
        <h7><?php
            $userEmail = $_SESSION['changePasswordUser']['email'];
            $userLogin = $_SESSION['changePasswordUser']['login'];
            echo "Your login -  <i style='color: darkblue'>$userLogin</i><br>
                  Your email <i style='color: darkblue'>$userEmail</i><br><br>
                  Enter new password: "; ?></h7>
        <hr>

        <label for="pswNew"><b>Password</b></label>
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
        <div class="clearfix">
            <button type="submit" class="submitbtn">Submit</button>
        </div>
    </div>
</form>

</body>

