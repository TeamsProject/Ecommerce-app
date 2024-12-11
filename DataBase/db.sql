
CREATE DATABASE ShopArt;
USE ShopArt;

CREATE TABLE Utilisateur (
    idUtilisateur INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(100) NOT NULL,
    tele VARCHAR(15),
    cin VARCHAR(20)  NOT NULL,
    genre ENUM('Homme', 'Femme'),
    role VARCHAR(20) ,
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
    CONSTRAINT fk_category FOREIGN KEY (category_id) REFERENCES Categories(id) ON DELETE SET NULL
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
    date_yaer TINYINT UNSIGNED CHECK (date_year BETWEEN 1 AND 31),
    date_month TINYINT UNSIGNED CHECK (date_month BETWEEN 1 AND 12),
    cvv_cart SMALLINT UNSIGNED CHECK (cvv_cart BETWEEN 100 AND 999),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_payment_order FOREIGN KEY (order_id) REFERENCES Orders(order_id) ON DELETE CASCADE
);
INSERT INTO `Utilisateur` (`firstName`, `lastName`, `email`, `password`, `tele`,`role`, `created_at`)
VALUES 
('Admin1', 'Lastname1', 'admin1@example.com', 'admin', '1234567890','admin', NOW()),
('Admin2', 'Lastname2', 'admin2@example.com', 'admin', '0987654321','admin', NOW()),
('Admin3', 'Lastname3', 'admin3@example.com', 'admin', '1122334455','admin', NOW()),
('Admin4', 'Lastname4', 'admin4@example.com', 'admin', '5566778899','admin', NOW());
INSERT INTO categories (name, description) VALUES
('Abstract', 'Art that does not attempt to represent external reality, but seeks to achieve its effect using shapes, colors, and textures.'),
('Landscape', 'Depictions of natural scenery such as mountains, valleys, trees, rivers, and forests.'),
('Portrait', 'Art focusing on representing a person, capturing their likeness, personality, or mood.'),
('Still Life', 'Art depicting mostly inanimate objects, like flowers, fruits, or household items.'),
('Realism', 'Art style that attempts to represent subject matter truthfully, without artificiality.'),
('Impressionism', 'Art characterized by small, thin brush strokes and an emphasis on light and its changing qualities.'),
('Surrealism', 'Art that seeks to unleash the creative potential of the unconscious mind, often through dreamlike imagery.'),
('Expressionism', 'Art emphasizing emotional experience over physical reality, often with bold colors and exaggerated forms.'),
('Modern', 'Art that embraces innovation and experimentation in form and technique.'),
('Pop Art', 'Art based on popular culture and mass media, often using bright colors and bold graphics.');
