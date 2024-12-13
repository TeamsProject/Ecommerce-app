<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="../css/contact.css">

</head>
<body>
    <?php 
        include("nav.php");
    ?>
    <div class="container">
        <div class="header">
            <?php 
            extract($_POST);
                if(isset($_POST["submit"])){
                    echo "<h4 class='feedback' >we received your email and will answer you as soon as possible</h4> 
                    <a href='home.php'><button class='home' >back</button></a>
                    ";
                }
            ?>
            <h1>Contact Us</h1>
        </div>

        <form method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="5" required></textarea>

            <button type="submit" name="submit" class="btn">Send</button>
        </form>
    </div>
</body>
</html>
