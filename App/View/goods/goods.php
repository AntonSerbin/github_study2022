<script defer>
    const fillInHTMLItems = async () => {
        let url = document.URL;
        index = url.lastIndexOf("goods/");
        params = url.slice(index).replace("goods/", "");
        console.log(params);
        requestStr = `http://localhost/api/goods/${params}`;
        const response = await fetch(requestStr);
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
                        <h3 class="card-title">${json[i]["title"]}</h3>

                        <div class="row">
                            <div class="col">
                          <p class="card-text"> ${json[i]["description"]}</p>

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
<link href="/node_modules/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
<link href="/App/View/style/style.css" rel="stylesheet">
<body>

<div class="indexWrapper">

    <?php require_once(ROOT . '/App/View/header/header.php'); ?>

    <main>
        <div class="container">

            <h3 style="text-align: center; padding: 30px">Our company bakes two types of the cakes.</h3>
            <h4 style="text-align: center;padding-bottom: 30px"> You can look through our range of products on this
                page.</h4>

            <div class="row">
                <div class="col-10">
                    <div class="row" id="itemField">
                        <!--elements added-->
                    </div>
                </div>
                <div class="col-2 sideNav">
                    <div class="card-header bg-primary text-white text-uppercase"><i class="fa fa-list"></i>
                        Categories
                    </div>
                    <ul class="list-group category_block">
                        <li class="list-group-item"><a href="/goods/all">All Cakes</a></li>
                        <li class="list-group-item"><a href="/goods/classic">Classic Cake</a></li>
                        <li class="list-group-item"><a href="/goods/wosugar">Cake w/o sugar</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <footer class="page-footer font-small blue">
        <div class="footer-copyright text-center py-3">© 2022 Copyright:
            <a href="index.html"> HW Nix </a>
        </div>
    </footer>
</div>

</body>