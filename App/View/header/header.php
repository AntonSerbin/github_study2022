<style>
<?php require_once (ROOT.'/node_modules/bootstrap/dist/css/bootstrap.css') ?>
</style>
<link rel="stylesheet" href="/App/View/style/style.css">
<header>
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/login">
                        <h1 class="section-title">
                            <span class="left-handle"></span>
                            <span class="title-text">HW AntonSerbin</span>
                            <span class="right-handle"></span>
                        </h1>
                    </a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="nav-item "><a href="/index">Home</a></li>
                    <li class="nav-item "><a href="/goods/all">Goods</a></li>
                    <li class="nav-item "><a href="/cart">Cart</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($_SESSION['user']['login'])) {
                        echo "You entered as " . $_SESSION['user']['login'];
                        echo '<li><a href="/logout" id="loginHeader"> LogOut </a></li>';
                    } else {
                        echo '<li><a href="#" id="loginHeader"> Login </a></li>';
                    } ?>
                </ul>
            </div>
        </nav>

    </header>