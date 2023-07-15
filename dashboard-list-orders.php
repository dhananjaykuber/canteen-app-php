<?php
include 'inc/header.php';

$query = 'SELECT users.name, orders.id, orders.order_date, orders.title, orders.price, orders.quantity, orders.served FROM orders JOIN users ON orders.user = users.id';


$result = mysqli_query($conn, $query);

$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

foreach ($orders as $order) {
    print_r($order);
}

?>

<h1>Orders</h1>

<div>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Quantity</th>
            <th>Order Date</th>
            <th>Status</th>
        </tr>

        <?php foreach ($orders as $order) {
        ?>

            <tr>
                <td><?php echo $order['id'] ?></td>
                <td><?php echo $order['title'] ?></td>
                <td><?php echo $order['quantity'] ?></td>
                <td><?php echo $order['order_date'] ?></td>
                <td><?php echo $order['served']  ? 'Served' : 'Not served <input type="checkbox"/>'; ?></td>
            </tr>
        <?php
        } ?>

    </table>
</div>

<?php include 'inc/footer.php'; ?>