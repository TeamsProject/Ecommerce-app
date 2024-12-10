
CREATE DATABASE ShopArt;
USE ShopArt;


CREATE TABLE Admin (
    idAdmin INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(100) NOT NULL,
    tele VARCHAR(15),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE Utilisateur (
    idUtilisateur INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(100) NOT NULL,
    tele VARCHAR(15),
    cin VARCHAR(20) UNIQUE NOT NULL,
    genre ENUM('Homme', 'Femme'),
    role ENUM('User', 'Admin') DEFAULT 'User',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE Categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT
);


CREATE TABLE Products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    image_url VARCHAR(255),
    category_id INT,
    admin_id INT,
    CONSTRAINT fk_category FOREIGN KEY (category_id) REFERENCES Categories(id) ON DELETE SET NULL,
    CONSTRAINT fk_admin FOREIGN KEY (admin_id) REFERENCES Admin(idAdmin) ON DELETE SET NULL
);


CREATE TABLE Cart (
    cart_id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_user_cart FOREIGN KEY (utilisateur_id) REFERENCES Utilisateur(idUtilisateur) ON DELETE CASCADE
);

CREATE TABLE CartItems (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cart_id INT,
    product_id INT,
    quantity INT NOT NULL,
    CONSTRAINT fk_cart FOREIGN KEY (cart_id) REFERENCES Cart(cart_id) ON DELETE CASCADE,
    CONSTRAINT fk_product FOREIGN KEY (product_id) REFERENCES Products(id) ON DELETE CASCADE
);


CREATE TABLE Orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT,
    total_price DECIMAL(10, 2) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('Pending', 'Completed', 'Cancelled') DEFAULT 'Pending',
    CONSTRAINT fk_user_order FOREIGN KEY (utilisateur_id) REFERENCES Utilisateur(idUtilisateur) ON DELETE CASCADE
);


CREATE TABLE OrderItems (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    CONSTRAINT fk_order FOREIGN KEY (order_id) REFERENCES Orders(order_id) ON DELETE CASCADE,
    CONSTRAINT fk_product_order FOREIGN KEY (product_id) REFERENCES Products(id) ON DELETE CASCADE
);


CREATE TABLE Payement (
    idPayement INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    num_cart VARCHAR(16) NOT NULL,
    date_day TINYINT UNSIGNED CHECK (date_day BETWEEN 1 AND 31),
    date_month TINYINT UNSIGNED CHECK (date_month BETWEEN 1 AND 12),
    cvv_cart SMALLINT UNSIGNED CHECK (cvv_cart BETWEEN 100 AND 999),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_payment_order FOREIGN KEY (order_id) REFERENCES Orders(order_id) ON DELETE CASCADE
);
