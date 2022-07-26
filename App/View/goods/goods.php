<script defer>
    const fillInHTMLItems = async () => {
        const response = await fetch('http://localhost/requestDataPage');
        console.log(response);
        const json = await response.json();
        console.log(json.length);
        let htmlF = "";
        for (let i = 0; i < json.length; i++) {
            let hrefLinkItem = "product" + i;
            htmlF +=
                `<div class="col-4">
            <div class="cardProduct">
                <img class="card-img-top" src="/App/View/images/${json[i]['image_name']}" alt="Cake${i}">
                    <div class="card-body">
                        <h4 class="card-title"><a href=${hrefLinkItem}>${json[i]["title"]}</a></h4>
                        <p class="card-text"> ${json[i]["title"]} </p>
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="btn btn-danger btn-block p-2"> ${json[i]['price']} UAH</p>
                            </div>
                            <div>
                                <a href="#" class="btn btn-success btn-block p-2">Add to cart</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <button class="btn btn-secondary btnAddInfo"
                                        onclick="window.location.href=hrefLinkItem/${json[i]["image_name"]}">Additional info
                                </button>
                            </div>
                        </div>
                    </div>
            </div>
                    </div>`;
        }
        const itemField = document.querySelector("#itemField");
        itemField.innerHTML = htmlF;
    }
    fillInHTMLItems();
</script>

<style type="text/css" media="all">
    <?php echo file_get_contents(ROOT.'/App/View/style/style.css'); ?>

</style>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'
      integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet'
      integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
<body>

<div class="indexWrapper">

    <button class="btn btn-primary btn-lg"
            onclick="window.location.href='/requestDataPage'">Show page RequestDataGoods
    </button>

    <header>
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        <h1 class="section-title">
                            <span class="left-handle"></span>
                            <span class="title-text">List of goods</span>
                            <span class="right-handle"></span>
                        </h1>
                    </a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="nav-item "><a href="index">Home</a></li>
                    <li class="nav-item "><a href="#">Goods</a></li>
                    <li class="nav-item "><a href="cart">Cart</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="login" id="loginPageHeader">
                            LoginPage
                        </a></li>

                </ul>


            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-10">
                    <div class="row" id="itemField">
                        <!--elements added-->
                    </div>
                </div>
                <div class="col-2 sideNav">
                    <div class="card-header bg-primary text-white text-uppercase"><i class="fa fa-list"></i> Categories
                    </div>
                    <ul class="list-group category_block">
                        <li class="list-group-item"><a href="#">Butter Cake</a></li>
                        <li class="list-group-item"><a href="#">Pound Cake</a></li>
                        <li class="list-group-item"><a href="#">Sponge Cake</a></li>
                        <li class="list-group-item"><a href="#">Genoise Cake</a></li>
                        <li class="list-group-item"><a href="#">Biscuit Cake</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <footer class="page-footer font-small blue">
        <div class="footer-copyright text-center py-3">© 2022 Copyright:
            <a href="index.html"> HW Nix</a>
        </div>
    </footer>
</div>

<!-- JavaScript Bundle with Popper -->


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>


</body>