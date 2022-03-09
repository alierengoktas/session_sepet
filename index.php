<link rel="stylesheet" href="style.css">

<?php 
// session start command
    session_start(); 


// if the delete button is pressed
    if(isset($_GET['delete'])){
        unset($_SESSION['productList'][$_GET['delete']]);
        header('Location:index.php');
    } 

// if the add to cart button is pressed
    if(isset($_GET['product'])){

    $product_array = array(
        "Product" => $_GET['product'],
        "Price" => $_GET['price'],
        "Count" => $_GET['count'],
        "Total" => $_GET['count']*$_GET['price']
    );

    $_SESSION["productList"][$_GET['product']] = $product_array;

    header('Location:index.php');

    }

    echo "<br>";



// if the empty the cart button is pressed
    if(isset($_POST['resetSession'])){
        session_destroy();
        header('Location:index.php');
    }



// total price calculate
        $total_price = 0;
        foreach($_SESSION['productList'] as $calculate){
            $total_price = $calculate['Total'] + $total_price;
    } ?>




<title>Shopping Cart Operations</title>

<?php $product_list = array('iPhone', 'MacBook', 'iPad', 'iMac'); ?>

<h1>Shopping Cart</h1>

<form method="GET" autocomplete="off">

    <select name="product">

<?php foreach($product_list as $products){ // product list ?>
    <option value="<?= $products ?>"><?= $products ?></option>
<?php } ?>

    </select>

    <input type="text" name="price" placeholder="Price">
    <input type="number" name="count" placeholder="Count">

    <button type="submit">Add To Cart</button>

</form>





<form method="post">
    <button type="submit" name="resetSession">Empty The Cart</button>
</form>



<table>
    <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Count</th>
        <th>Total</th>
        <th></th>
    </tr>


    <?php foreach($_SESSION['productList'] as $list){ ?>
    <tr>
        <td><?= $list['Product'] ?></td>
        <td>₺<?= $list['Price'] ?></td>
        <td><?= $list['Count'] ?></td>
        <td>₺<?= $list['Total'] ?></td>
        <td><a href="?delete=<?= $list['Product'] ?>">Delete</a></td>
    </tr>
<?php } ?>


</table>


<table>
    <tr>
        <td style="text-align:right;"><b>Total Price :</b> ₺<?= $total_price ?></td>

    </tr>
</table>


