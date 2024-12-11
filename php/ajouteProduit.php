    <?php
        include("connect.php");
        $query = "SELECT * from categories";
        $result = mysqli_query($con, $query);
        $categories = mysqli_fetch_all($result,MYSQLI_ASSOC);

        if(isset($_POST['submit'])){
            extract($_POST);
            $source = $_FILES['photo']['tmp_name'];
            $destination ="../images/".$_FILES['photo']['name'];
            move_uploaded_file($source, $destination);
        $query = "INSERT into products(`name`,`description`,`image_url`,`category_id`,`price`) values('$name','$description','$destination','$category_id','$price')";
        $result = mysqli_query($con, $query);

}
    ?>
    

    <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Form</title>
    <link rel="stylesheet" href="../css//ajouteProduit.css">
</head>
<body>
    <div class="form-container">
        <h2>Add Product</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="firstrow">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name">
                <label for="description">Description</label>
                <input type="text" name="description" id="description">
            </div>
            <div class="secondrow">
                <label for="photo">Photo</label>
                <input type="file" name="photo" id="photo">
                <label for="category_id">Category</label>
                <select name="category_id">
                    <option value="-1">Select Category</option>
                    <?php foreach($categories as $categorie): ?>
                        <option value="<?= $categorie['id'] ?>"><?= $categorie['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="thirdrow">
                <label for="price">Price</label>
                <input type="number" name="price" id="price">
            </div>
            <input type="submit" value="Submit" name="submit">
        </form>
    </div>
</body>
</html>