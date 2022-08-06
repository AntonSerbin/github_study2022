<header>
    <link rel="stylesheet" href="/App/View/style/style.css">
</header>
<body>
<div class="indexWrapper">

    <?php require_once (ROOT.'/App/View/header/header.php'); ?>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <img class="indexMainImage" src="App/View/images/index_main_image.jpg" alt="main-logo">
                </div>
                <div class="col-4 indexArticle">
                    <p>We believe in the art of homemade baked goods. That’s why we
                        never
                        skimp, and we handcraft each pastry with high quality, natural, and locally-sourced
                        ingredients.
                        Specializing in muffins, brownies, blondies, bars, cookies, and scones, we’re a home bakery
                        catering to all occasions throughout the Phoenix metro area.</p>
                    <p> Specializing in muffins, brownies, blondies, bars, cookies, and scones, we’re a home bakery
                        catering to all occasions throughout the Phoenix metro area.</p>
                </div>
                <div class="col-2 loginForm">
                    <form action="/checkPassword" method="post">
                        <div class="form-outline mb-4">
                            <label class="form-label">User Login</label>
                            <input name="uName" type="text" class="form-control" required value="Anton"/>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" name="psw" id="form1Example2" class="form-control" required/>
                            <label class="form-label" for="form1Example2" value="1">Password</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                    </form>
                    <button id="signinButton"
                            onclick="location.href='signin'"
                            class='btn btn-primary btn-block'>SignIn new User
                    </button>
                    <button id="restoreButton"
                            onclick="location.href='resetLoginForm'"
                            class="btn btn-outline-danger btn-block">Reset Password
                    </button>
                </div>
            </div>
        </div>
    </main>

    <footer class="page-footer font-small blue">
        <div class="footer-copyright text-center py-3">© 2022 Copyright:
            <a href="#"> HW Nix</a>
        </div>
    </footer>

</div>

<script>

    let loginHeader = document.querySelector("#loginHeader");
    let loginForm = document.querySelector(".loginForm");
    loginHeader.addEventListener('click', () => {
        document.querySelector(".loginForm").classList.add("active")
    });


</script>


<script src="public/js/main.js"></script>

</body>