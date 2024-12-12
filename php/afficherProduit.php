<?php 
include('connect.php');

$category_query = "SELECT * FROM categories";
$category_result = mysqli_query($con, $category_query) or die("Erreur de la requête");

$category_filter = isset($_POST['category']) ? $_POST['category'] : '';

$query = "SELECT products.*, categories.name AS category_name FROM products 
          LEFT JOIN categories ON products.category_id = categories.id";

if (!empty($category_filter)) {
    $query .= " WHERE products.category_id = '$category_filter'";
}

$result = mysqli_query($con, $query) or die("Erreur de la requête");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/afficherProduit.css">
    <title>Produits</title>
</head>
<body>
    <div class="container my-5">
        <form action="" method="post" class="w-70 d-flex">
            <select class="form-control w-25" name="category">
                <option value="">Sélectionner une catégorie</option>
                <?php
                while ($category = mysqli_fetch_assoc($category_result)) {
                    echo "<option value='" . $category['id'] . "'>" . htmlspecialchars($category['name']) . "</option>";
                }
                ?>
            </select>
            <button class="btn" type="submit">Filtrer</button>
        </form>
    </div>

    <div class="container">
        <div class="row">
            <?php  
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $product_name = $row['name'];
                    $product_description = $row['description'];
                    $product_price = $row['price'];
                    $product_category = $row['category_name'];
                    $product_image = $row['image_url'];

                    echo '<div class="col-md-3 mb-4">
                            <a href="detailProduit.php?id=' . $row['id'] . '" style="text-decoration: none; color: inherit;">
                                <div class="product-card">
                                    <img src="' . $product_image . '" class="product-image" alt="' . $product_name . '">
                                    <div class="product-info">
                                        <p class="product-title">' . $product_name . '</p>
                                        <p class="product-description">' . $product_description . '</p>
                                        <div>
                                            <span class="product-price"> ' . number_format($product_price, 2) . ' DH</span>
                                        </div>
                                        <p class="product-category">Catégorie: ' . $product_category . '</p>
                                        <button class="btn btn-order-now">Order Now</button>
                                    </div>
                                </div>
                            </a>
                        </div>';
                }
            } else {
                echo '<h4 class="text-danger">Aucun produit trouvé pour cette catégorie</h4>';
            }
            ?>
        </div>
    </div>
</body>
</html>
