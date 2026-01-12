CREATE DATABASE loyaltyPoints ;
use loyaltyPoints;

CREATE TABLE users (

id INT PRIMARY KEY AUTO_INCREMENT,

email VARCHAR(100) UNIQUE NOT NULL,

password_hash VARCHAR(255) NOT NULL,

name VARCHAR(100),

total_points INT DEFAULT 0,

earned_points int DEFAULT 0,

createdat TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);

CREATE table goods (
    id INT PRIMARY key AUTO_INCREMENT,
    name VARCHAR(50) ,
    category VARCHAR(50),
    image_link text,
    quantity int DEFAULT 0,
    price int ,
    rate ENUM('1','2','3','4','5') NOT null 
);

ALTER TABLE goods
ADD COLUMN name VARCHAR(100) AFTER id;

UPDATE goods SET name = 
    CASE id
       
        WHEN 1 THEN 'iPhone 14 128GB - Noir Minuit'
        WHEN 2 THEN 'Samsung Galaxy S23 Ultra 256GB - Vert'
        WHEN 3 THEN 'Google Pixel 7a 128GB - Charbon'
        
        WHEN 4 THEN 'MacBook Air M2 13" 256GB - Gris Sidéral'
        WHEN 5 THEN 'Lenovo Yoga 7i 14" Intel i7 - Bleu'
        
        WHEN 6 THEN 'Philips Airfryer XXL 6.2L - Noir'
        WHEN 7 THEN 'Nespresso Vertuo Next - Argent'
        
        WHEN 8 THEN 'Lampe de Table LED Moderne - Or Rose'
        WHEN 9 THEN 'Lot de 4 Coussins Déco Velours - Gris'
        
        WHEN 10 THEN 'Nike Air Force 1 - Blanc / Blanc'
        WHEN 11 THEN 'Adidas Forum Low - Blanc / Bleu'
        WHEN 12 THEN 'Casio Edifice Chrono - Acier'
        WHEN 13 THEN 'Fossil Carlie Mini - Cuir Rose'
        WHEN 14 THEN 'Ray-Ban Wayfarer Classic - Noir'
        
        WHEN 15 THEN 'Calvin Klein CK One Eau de Toilette 100ml'
        WHEN 16 THEN 'Paco Rabanne Lady Million 80ml'
        WHEN 17 THEN 'The Ordinary Niacinamide 10% + Zinc 1% - 30ml'
      
        WHEN 18 THEN 'Manette PS5 DualSense - Rouge Cosmique'
        WHEN 19 THEN 'Logitech G Pro X Superlight Souris Gaming - Noir'
        ELSE name 
    END
WHERE id BETWEEN 1 AND 19;



INSERT INTO goods (category, image_link, quantity, price, rate) VALUES

('Smartphones', 'https://img.freepik.com/vecteurs-libre/affichage-realiste-pour-smartphone-differentes-applications_52683-30241.jpg', 12, 8500, '4'),
('Smartphones', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRUACMS8hvAZ2ekDh6e4xzYK8Wza4u58NPm_A&s', 8,  12400, '5'),
('Smartphones', 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDE0fHx8ZW58MHx8fHx8',  15, 5200,  '4'),
('Laptops',     'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTceHxeMDdPK2vh4LRbRIQUbXm4HiaqA-ENbg&s', 5, 14500, '5'),
('Laptops',     'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQy7gYvZSeKv3EuF7P8MUkW-ccuHECe_nhmg&s', 7, 9200,  '4'),


('Kitchen Appliances', 'https://media.istockphoto.com/id/1201141649/photo/airfryer-isolated.jpg?s=612x612&w=0&k=20&c=ekL_tqETdNKm5oV1U_Q5h3fjXQXWWt7XCFWYrf4HRxs=',     18, 1800, '4'),
('Kitchen Appliances', 'https://t3.ftcdn.net/jpg/01/35/29/46/360_F_135294612_53HwG3IduSxwEG1ZeRuQKS4om6Yu1vSw.jpg', 14, 1200, '3'),
('Home Decor',         'https://media.istockphoto.com/id/1077181930/photo/turquoise-table-lamp-in-a-classic-style.jpg?s=612x612&w=0&k=20&c=oODZUIwkmpp3PYepvLxYhUOZPCm_UJ73gQBZDsB3vZc=',    25,  450, '4'),
('Home Decor',         'https://luxurahome.co.uk/wp-content/uploads/2024/10/TheChampagneCarriocaSet.jpg-2.webp',   40,  320, '3'),


('Sneakers',    'https://t4.ftcdn.net/jpg/04/79/11/23/360_F_479112366_dku6Ufwd9OVnRB3AZxonMgRzuZYeTTYY.jpg',  22, 2200, '5'),
('Sneakers',    'https://assets.adidas.com/images/w_1880,f_auto,q_auto/67a5245996f44aa39e00f77af3548817_9366/IH7829_01_standard.jpg',   19, 1850, '4'),
('Watches',     'https://watchesprime.com/wp-content/uploads/2018/10/1-34.jpg',  11, 1400, '4'),
('Watches',     'https://www.fields.ie/dw/image/v2/BFNQ_PRD/on/demandware.static/-/Sites-ang_master-catalog/default/dwf12bca38/hi-res/es5439-fossil-carlie-28mm-green-dial-two-tone-stainless-steel-bracelet-watch-18-14-1-0237-img1.jpg?sw=1000&sh=1000&sm=fit',   9, 2100, '5'),
('Sunglasses',  'https://dubaioptical.com/cdn/shop/files/ray-ban-sunglasses-wayfarer-rb2140-129433-50-black-on-transparent-1198516685.jpg?v=1760965815&width=1200',17, 1600, '5'),


('Perfumes',    'https://i0.wp.com/zino.ci/wp-content/uploads/2024/11/MODEL-IMAGE-2024-11-14T153323.374.jpg?fit=1500%2C1500&ssl=1',        20, 950,  '4'),
('Perfumes',    'https://kosmenia.ma/cdn/shop/products/Paco-rabanne-lady-million-eau-de-parfum_580x.jpg?v=1588024234',  13, 1450, '5'),
('Skincare',    'https://cdn11.bigcommerce.com/s-63354/images/stencil/original/products/8639/22879/The_Ordinary_The_Bright_Set__25021.1731938023.jpg?c=2', 30, 650, '4'),


('Gaming',      'https://www.ultrapc.ma/53224/manette-ps5-dualsense-edge-noir.jpg',  6, 2800, '5'),
('Gaming',      'https://www.ultrapc.ma/15874-large_default/logitech-g-pro-x-gaming-headset-noir.jpg', 10, 1600, '4');

CREATE TABLE points_transactions (

id INT PRIMARY KEY AUTO_INCREMENT,

user_id INT NOT NULL,

type ENUM('earned', 'redeemed', 'expired') NOT NULL,

amount INT NOT NULL,

description VARCHAR(255),

balance_after INT NOT NULL,

createdat TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE

);

CREATE TABLE rewards (

id INT PRIMARY KEY AUTO_INCREMENT,

name VARCHAR(100) NOT NULL,

points_required INT NOT NULL,

description TEXT,

stock INT DEFAULT 0 

);

INSERT INTO users (email, password_hash, name, total_points, earned_points) VALUES
('youssef@gmail.com',    'hashed_pass_123', 'Youssef El Amrani',     1240, 1840),
('amina.rahali@live.ma', 'abcXYZ2024!!',    'Amina Rahali',           350,  950),
('khalid.ben@gmail.com', 'khalid2025secure','Khalid Bensouda',       2180, 3180),
('sara.mounir@icloud.com','sara_strong_99',  'Sara Mounir',             80, 1080),
('omar.harrak@yahoo.fr', 'omar_0600loyal',   'Omar Harrak',           4120, 5620),
('yahyajaatouri2000@gmail.com','000000','yahya jaatouri',0,200000);

INSERT INTO rewards (name, points_required, description, stock) VALUES
('100 DH voucher – Jumia',                 1200, 'Code promo valable sur Jumia Maroc',               18),
('Café + croissant gratuit – Paul',         450, ' valable dans les boutiques Paul Casablanca & Rabat',  25),
('T-shirt personnalisé (basic)',            890, 'Choix parmi 5 couleurs – livraison offerte',         12),
('50 DH réduction – Shein / command ≥ 300 DH', 650, 'Code unique – valable 30 jours',                     40),
('Ticket cinéma 2D – Megarama',             800, ' valable tous les mardis & mercredis',               30),
('Parfum 50 ml – Yves Rocher / The Body Shop', 1950, 'Choix parmi plusieurs références',                   7),
('Recharge téléphonique 50 DH (Inwi/Orange/IAM)', 600, 'Recharge directe sur le numéro enregistré',         100),
('Goodie bag surprise (valeur ~180 DH)',    1400, 'Contenu surprise – cosmétique / accessoires',        15),
('Écharpe ou bonnet hiver marque locale',   975,  'Laine ou coton – plusieurs coloris',                 9);

INSERT INTO points_transactions (user_id, type, amount, description, balance_after) VALUES


(1, 'earned',    200, 'Achat ≥ 500 DH – magasin partenaire',           200),
(1, 'earned',    450, 'Parrainage ami inscrit + premier achat',         650),
(1, 'earned',    300, 'Avis produit laissé (5★)',                      950),
(1, 'earned',    890, 'Anniversaire – cadeau fidélité',               1840),
(1, 'redeemed', -600, 'Recharge téléphonique 50 DH',                  1240),


(2, 'earned',    150, 'Inscription + vérification email/téléphone',    150),
(2, 'earned',    800, 'Achat première commande ≥ 800 DH',             950),
(2, 'redeemed', -450, 'Café + croissant Paul',                        500),
(2, 'redeemed', -150, 'Petite réduction – test',                      350),


(3, 'earned',   1200, 'Gros achat – électroménager',                  1200),
(3, 'earned',    980, 'Parrainage × 2 amis',                          2180),
(3, 'earned',   1000, 'Anniversaire + achat le même mois',            3180),
(3, 'redeemed',-1000, '100 DH voucher Jumia',                         2180),


(4, 'earned',    180, 'Inscription + remplir profil',                 180),
(4, 'earned',    900, 'Achat ≥ 600 DH première commande',            1080),
(4, 'redeemed', -500, 'Ticket cinéma + popcorn (promo soir)',         580),
(4, 'redeemed', -500, 'Ticket cinéma (autre mois)',                    80),


(5, 'earned',   2500, 'Achat très élevé – électroménager + TV',       2500),
(5, 'earned',   1200, 'Parrainage × 3 + bonus premium',               3700),
(5, 'earned',   1920, 'Achats réguliers sur 4 mois (bonus fidélité)', 5620),
(5, 'redeemed',-1500, 'Parfum 50 ml + goodie bag',                    4120);

UPDATE goods 
SET name = CASE id
    WHEN 1  THEN 'iPhone 14 128GB - Noir Minuit'
    WHEN 2  THEN 'Samsung Galaxy S23 Ultra 256GB - Vert'
    WHEN 3  THEN 'Google Pixel 7a 128GB - Charbon'
    WHEN 4  THEN 'MacBook Air M2 13" 256GB - Gris Sidéral'
    WHEN 5  THEN 'Lenovo Yoga 7i 14" Intel i7 - Bleu'
    WHEN 6  THEN 'Philips Airfryer XXL 6.2L - Noir'
    WHEN 7  THEN 'Nespresso Vertuo Next - Argent'
    WHEN 8  THEN 'Lampe de Table LED Moderne - Or Rose'
    WHEN 9  THEN 'Lot de 4 Coussins Déco Velours - Gris'
    WHEN 10 THEN 'Nike Air Force 1 - Blanc / Blanc'
    WHEN 11 THEN 'Adidas Forum Low - Blanc / Bleu'
    WHEN 12 THEN 'Casio Edifice Chrono - Acier'
    WHEN 13 THEN 'Fossil Carlie Mini - Cuir Rose'
    WHEN 14 THEN 'Ray-Ban Wayfarer Classic - Noir'
    WHEN 15 THEN 'Calvin Klein CK One Eau de Toilette 100ml'
    WHEN 16 THEN 'Paco Rabanne Lady Million 80ml'
    WHEN 17 THEN 'The Ordinary Niacinamide 10% + Zinc 1% - 30ml'
    WHEN 18 THEN 'Manette PS5 DualSense - Rouge Cosmique'
    WHEN 19 THEN 'Logitech G Pro X Superlight Souris Gaming - Noir'
    ELSE name
END
WHERE name IS NULL OR name = '';

DROP DATABASE loyaltyPoints;