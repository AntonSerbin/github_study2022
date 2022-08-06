<div id='app'>
    <main>
        <div style="margin: 40px">
            <h1 style="margin-bottom:20px "> Thank you for your order № <?= $orderData[0]["id_order"]?></h1>
            <h4>Information about receiver:</h4>
            <h6>First name: <?= $orderData[0]['firstName']?></h6>
            <h6>Last name: <?= $orderData[0]['lastName']?></h6>
            <h6>City: <?= $orderData[0]['city']?></h6>
            <h6>Address: <?= $orderData[0]['address']?></h6>
            <h6>Email: <?= $orderData[0]['email']?></h6>
            <h6>Phone: <?= $orderData[0]['phone']?></h6>
        </div>

        <table class="table" style="width: 50%; margin: 50px" >
            <thead>
                <th scope="col">#</th>
                <th scope="col">Code</th>
                <th scope="col">Title</th>
                <th scope="col">Amount</th>
                <th scope="col">Price, usd</th>
                <th scope="col">Sum, usd</th>
            </thead>
            <tbody>
            <?php
            $sumCart = 0;
            for ($i=0;$i<count($orderData);$i++) {
              echo "<tr>";
                echo "<th scope='row'>".($i+1)."</th>";
                echo "<td >".$orderData[$i]['id_good']."</td>";
                echo "<td >".$orderData[$i]['title']."</td>";
                echo "<td >".$orderData[$i]['quantity']."</td>";
                echo "<td >".$orderData[$i]['price']."</td>";
                echo "<td >".$orderData[$i]['price']*$orderData[$i]['quantity']."</td>";
              echo "<tr>";
                $sumCart+=$orderData[$i]['price']*$orderData[$i]['quantity'];
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