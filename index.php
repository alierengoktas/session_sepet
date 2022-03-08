<?php session_start(); ?>

<title>Sepet İşlemleri</title>
<link rel="stylesheet" href="style.css">

<?php $urun_list = array('iPhone', 'MacBook', 'iPad', 'iMac'); ?>

<h1>Sepet İşlemleri</h1>

<form method="GET" autocomplete="off">

    <select name="product">

<?php foreach($urun_list as $urunler){ ?>
    <option value="<?= $urunler ?>"><?= $urunler ?></option>
<?php } ?>

    </select>

    <input type="text" name="price" placeholder="Birim Fiyat">
    <input type="number" name="count" placeholder="Adet">

    <button type="submit">Sepete Ekle</button>

</form>




<?php 


if(isset($_GET['product'])){

    $urun_array = array(
        "Product" => $_GET['product'],
        "Price" => $_GET['price'],
        "Count" => $_GET['count'],
        "Total" => $_GET['count']*$_GET['price']
    );

    $_SESSION["productList"][$_GET['product']] = $urun_array;

    header('Location:index.php');

}

echo "<br>";
/*
echo "<pre>";
    if($_SESSION){
print_r($_SESSION); 
    }
echo "</pre>";
*/
?>



<form method="post">
    <button type="submit" name="resetSession">Sepeti Boşalt</button>
</form>

<?php 

    if(isset($_POST['resetSession'])){
        session_destroy();
        header('Location:index.php');
    }

?>





<table>
    <tr>
        <th>Ürün</th>
        <th>Fiyat</th>
        <th>Adet</th>
        <th>Toplam</th>
        <th>İşlem</th>
    </tr>


    <?php 


foreach($_SESSION['productList'] as $listele){ ?>
    <tr>
        <td><?= $listele['Product'] ?></td>
        <td>₺<?= $listele['Price'] ?></td>
        <td><?= $listele['Count'] ?></td>
        <td>₺<?= $listele['Total'] ?></td>
        <td><a href="?sil=<?= $listele['Product'] ?>">Sil</a></td>
    </tr>
<?php } ?>



</table>


<?php 
        $total_price = 0;

        foreach($_SESSION['productList'] as $hesapla){
            $total_price = $hesapla['Total'] + $total_price;
        }


?>



<table>
    <tr>
        <td style="text-align:right;"><b>Toplam :</b> ₺<?= $total_price ?></td>

    </tr>
</table>



<?php 

    if(isset($_GET['sil'])){
        unset($_SESSION['productList'][$_GET['sil']]);
        header('Location:index.php');
    }


?>