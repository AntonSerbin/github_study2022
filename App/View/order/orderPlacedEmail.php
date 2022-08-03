<!--<link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.css" xmlns="http://www.w3.org/1999/html">-->
<!--<link rel="stylesheet" href="/App/View/style/style.css">-->
<?php
<div id='app'>
    <main>
        <div style="margin: 40px">
            <h1 style="margin-bottom:20px "> Thank you for your order</h1>
            <h4>Information about receiver:</h4>
            <h6>First name: <?= $userOrder['firstName']?></h6>
            <h6>Last name: <?= $userOrder['lastName']?></h6>
            <h6>City: <?= $userOrder['city']?></h6>
            <h6>Address: <?= $userOrder['address']?></h6>
            <h6>Email: <?= $userOrder['email']?></h6>
            <h6>Phone: <?= $userOrder['phone']?></h6>
        </div>

        <table class="table" style="width: 50%; margin: 50px" >
            <thead>
                <th scope="col">#</th>
                <th scope="col">Id_item</th>
                <th scope="col">Title</th>
                <th scope="col">Amount</th>
                <th scope="col">Price, usd</th>
                <th scope="col">Sum, usd</th>
            </thead>
            <tbody>
            <?php
            $sumCart = 0;
            for ($i=0;$i<count($userCart);$i++) {
              echo "<tr>";
                echo "<th scope='row'>".($i+1)."</th>";
                echo "<td >".$userCart[$i]['id_good']."</td>";
                echo "<td >".$userCart[$i]['title']."</td>";
                echo "<td >".$userCart[$i]['amount']."</td>";
                echo "<td >".$userCart[$i]['price']."</td>";
                echo "<td >".$userCart[$i]['price']*$userCart[$i]['amount']."</td>";
              echo "<tr>";
                $sumCart+=$userCart[$i]['price']*$userCart[$i]['amount'];
                }
                echo "<th scope='row'></th>";
                echo "<td ></td>";
                echo "<td ></td>";
                echo "<td ></td>";
                echo "<th > Sum of order:</th>";
                echo "<th >".$sumCart."</th>";
                echo "</tr>";
                ?>
            </tbody>
        </table>


    </main>
</div>