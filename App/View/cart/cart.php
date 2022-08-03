<link rel="stylesheet" href="/App/View/style/style.css">
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
                    <li class="nav-item "><a href="/index">Home</a></li>
                    <li class="nav-item "><a href="/goods/category=all">Goods</a></li>
                    <li class="nav-item "><a href="/cart">Cart</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($_SESSION['user']['login'])) {
                        echo "You entered as " . $_SESSION['user']['login'];
                        echo '<li><a href="/logout" id="loginHeader"> LogOut </a></li>';
                    } else {
                    echo '
                    <li><a href="/login" id="loginHeader"> Login </a></li>
                    ';
                    } ?>
                </ul>

            </div>
        </nav>
    </header>

    <div class="sideNav row">
            <div class="right">
                <div class="card-header bg-primary text-white text-uppercase">
                    <i class="fa fa-list"></i> Categories
                </div>
                <ul class="list-group list-group-horizontal">
                    <li class="flex-fill list-group-item"><a href="/goods/category=all">All Cakes</a></li>
                    <li class="flex-fill list-group-item"><a href="/goods/category=classic">Classic Cake</a></li>
                    <li class="flex-fill list-group-item"><a href="/goods/category=wosugar">Cake w/o sugar</a></li>
                </ul>
            </div>
        </div>
    <div id="app">
        <main>

            <cart-button
                    style="display:block;
                    margin:20px auto;
                    transform: scale(200%);
                    position: absolute">
            </cart-button>
            <router-view :someProp=<?php echo "data"> ></router-view>
            <products-list ></products-list>
            <cart-modal></cart-modal>
        </main>
    </div>
</div>
<script src="/public/js/main.js"></script>
</body>
