<?php
include 'inc/header.php';

$query = 'SELECT * from food_items';

$result = mysqli_query($conn, $query);

$food_items = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_POST['submit'])) {

    $quantity = $_POST['quantity'];
}


?>

<div>
    <h1>Food Menus</h1>

    <div class="food-items">
        <?php
        foreach ($food_items as $item) {
        ?>
            <div data-id="<?php echo $item['id'] ?>">
                <img style="width:100px" id="item-image" src="<?php echo $item['image'] ?>" alt="<?php echo $item['title'] ?>">
                <div>
                    <h3 id="item-title"><?php echo $item['title']; ?></h3>
                    <p id="item-price">Rs. <?php echo $item['price']; ?></p>
                    <span><?php echo $item['availability'] ? 'Available'  : 'Not available'; ?></span>
                    <input type="number" id="item-quantity" name="quantity" value="1" min=1>
                    <input type="submit" value="Add to cart" name="submit" onclick="handleAddToCart(event, <?php echo $item['id'] ?>);">
                </div>
            </div>
        <?php
        }

        ?>
    </div>
</div>

<?php include 'inc/footer.php'; ?>