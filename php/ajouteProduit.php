<?php
include("connect.php");

$query = "SELECT * FROM categories";
$result = mysqli_query($con, $query);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_POST['submit'])) {
    extract($_POST);

    $source = $_FILES['photo']['tmp_name'];
    $destination = "../images/" . $_FILES['photo']['name'];
    move_uploaded_file($source, $destination);

    $query = "INSERT INTO products(`name`, `description`, `image_url`, `category_id`, `price`) 
              VALUES('$name', '$description', '$destination', '$category_id', '$price')";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "<script>alert('Produit ajouté avec succès');</script>";
    } else {
        echo "<script>alert('Erreur lors de l\'ajout du produit');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Produit</title>
    <link rel="stylesheet" href="../css/ajouteProduit.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>
    <div class="form-container">
        <h1 class="text-center mb-4">Ajouter un Produit</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="firstrow">
                <label for="name" >Nom du Produit</label>
                <input type="text" name="name" id="name" class="form-control" required>
                <label for="description">Description</label>
                <input type="text" name="description" id="description" class="form-control" required>
            </div>
            <div class="secondrow">
                <label for="photo">Photo</label>
                <input type="file" name="photo" id="photo" class="form-control" required>
                <label for="category_id">Catégorie</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">Sélectionner une catégorie</option>
                    <?php foreach ($categories as $categorie): ?>
                        <option value="<?= $categorie['id'] ?>"><?= $categorie['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="thirdrow">
                <label for="price">Prix</label>
                <input type="number" name="price" id="price" step="0.01" class="form-control mb-3" required>
            </div>
            <input type="submit" value="Ajouter Produit" name="submit">
        </form>
    </div>
</body>
</html>
