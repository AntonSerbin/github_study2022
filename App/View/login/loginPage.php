<style type="text/css" media="all">
    <?php echo file_get_contents(ROOT.'/App/View/style/styles.css'); ?>
</style>

<body>
<div class="indexWrapper">

    <header>
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        <h1 class="section-title">
                            <span class="left-handle"></span>
                            <span class="title-text">HW AntonSerbin</span>
                            <span class="right-handle"></span>
                        </h1>
                    </a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="nav-item "><a href="index">Home</a></li>
                    <li class="nav-item "><a href="goods">Goods</a></li>
                    <li class="nav-item "><a href="cart">Cart</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($_SESSION['user']['login'])) {
                        echo "You entered as ".$_SESSION['user']['login'];
                        echo '<li><a href="/logout" id="loginHeader"> LogOut </a></li>';
                        } else {
                        echo '<li><a href="#" id="loginHeader"> Login </a></li>';
                        }?>
                </ul>
            </div>
        </nav>
    </header>

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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<!--<script src="script.js"></script>-->
<script>

    let loginHeader = document.querySelector("#loginHeader");
    let loginForm = document.querySelector(".loginForm");
    loginHeader.addEventListener('click', () => {
        document.querySelector(".loginForm").classList.add("active")
    });


</script>
</body>