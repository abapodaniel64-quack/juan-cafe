-- ============================================================
-- JUAN CAFÉ - Database Schema
-- File: database/juan_cafe.sql
-- Engine: MySQL 5.7+ / MariaDB 10.3+
-- Usage: Import via phpMyAdmin or: mysql -u root -p < juan_cafe.sql
-- ============================================================

CREATE DATABASE IF NOT EXISTS juan_cafe CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE juan_cafe;

-- ============================================================
-- TABLE: users
-- ============================================================
CREATE TABLE IF NOT EXISTS users (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(100)        NOT NULL,
    email       VARCHAR(150)        NOT NULL UNIQUE,
    password    VARCHAR(255)        NOT NULL,              -- bcrypt hash
    phone       VARCHAR(20)         DEFAULT NULL,
    address     TEXT                DEFAULT NULL,
    role        ENUM('user','admin') NOT NULL DEFAULT 'user',
    is_active   TINYINT(1)          NOT NULL DEFAULT 1,
    created_at  DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at  DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- TABLE: categories
-- ============================================================
CREATE TABLE IF NOT EXISTS categories (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(100)  NOT NULL,
    slug        VARCHAR(100)  NOT NULL UNIQUE,
    description TEXT          DEFAULT NULL,
    icon        VARCHAR(10)   DEFAULT '☕',               -- emoji icon
    sort_order  INT           NOT NULL DEFAULT 0,
    is_active   TINYINT(1)   NOT NULL DEFAULT 1,
    created_at  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- TABLE: products
-- ============================================================
CREATE TABLE IF NOT EXISTS products (
    id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category_id  INT UNSIGNED        NOT NULL,
    name         VARCHAR(150)        NOT NULL,
    slug         VARCHAR(150)        NOT NULL UNIQUE,
    description  TEXT                DEFAULT NULL,
    price        DECIMAL(8,2)        NOT NULL DEFAULT 0.00,
    image        VARCHAR(255)        DEFAULT NULL,          -- relative path under /public/assets/images/
    stock        INT                 NOT NULL DEFAULT 0,
    is_available TINYINT(1)          NOT NULL DEFAULT 1,
    is_featured  TINYINT(1)          NOT NULL DEFAULT 0,
    created_at   DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at   DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- TABLE: orders
-- ============================================================
CREATE TABLE IF NOT EXISTS orders (
    id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id      INT UNSIGNED        NOT NULL,
    order_number VARCHAR(20)         NOT NULL UNIQUE,      -- e.g. JC-00124
    status       ENUM(
                     'pending',
                     'confirmed',
                     'preparing',
                     'ready',
                     'completed',
                     'cancelled'
                 ) NOT NULL DEFAULT 'pending',
    subtotal     DECIMAL(10,2)       NOT NULL DEFAULT 0.00,
    delivery_fee DECIMAL(8,2)        NOT NULL DEFAULT 0.00,
    discount     DECIMAL(8,2)        NOT NULL DEFAULT 0.00,
    total        DECIMAL(10,2)       NOT NULL DEFAULT 0.00,
    notes        TEXT                DEFAULT NULL,
    created_at   DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at   DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- TABLE: order_items
-- ============================================================
CREATE TABLE IF NOT EXISTS order_items (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_id    INT UNSIGNED       NOT NULL,
    product_id  INT UNSIGNED       NOT NULL,
    product_name VARCHAR(150)      NOT NULL,               -- snapshot at time of order
    price       DECIMAL(8,2)       NOT NULL,
    quantity    INT                NOT NULL DEFAULT 1,
    subtotal    DECIMAL(10,2)      NOT NULL,
    FOREIGN KEY (order_id)   REFERENCES orders(id)   ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- TABLE: cart (server-side cart — supplements JS cart)
-- ============================================================
CREATE TABLE IF NOT EXISTS cart (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id     INT UNSIGNED       NOT NULL,
    product_id  INT UNSIGNED       NOT NULL,
    quantity    INT                NOT NULL DEFAULT 1,
    added_at    DATETIME           NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uq_user_product (user_id, product_id),
    FOREIGN KEY (user_id)    REFERENCES users(id)    ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- TABLE: notifications
-- ============================================================
CREATE TABLE IF NOT EXISTS notifications (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id     INT UNSIGNED        NOT NULL,
    type        VARCHAR(50)         NOT NULL DEFAULT 'info',  -- info | success | warning | order
    title       VARCHAR(200)        NOT NULL,
    message     TEXT                NOT NULL,
    is_read     TINYINT(1)          NOT NULL DEFAULT 0,
    created_at  DATETIME            NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- TABLE: admins (separate admin credentials)
-- ============================================================
CREATE TABLE IF NOT EXISTS admins (
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100)  NOT NULL,
    email      VARCHAR(150)  NOT NULL UNIQUE,
    password   VARCHAR(255)  NOT NULL,
    is_active  TINYINT(1)   NOT NULL DEFAULT 1,
    created_at DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- SEED: categories
-- ============================================================
INSERT INTO categories (name, slug, icon, sort_order) VALUES
    ('Milk Tea',    'milk-tea',    '🧋', 1),
    ('Coffee',      'coffee',      '☕', 2),
    ('Fruit Tea',   'fruit-tea',   '🍵', 3),
    ('Frappe',      'frappe',      '🥤', 4),
    ('Latte',       'latte',       '🍶', 5),
    ('Hot Drinks',  'hot-drinks',  '♨️', 6),
    ('Fruity Soda', 'fruity-soda', '🍹', 7),
    ('Premium',     'premium',     '✨', 8);

-- ============================================================
-- SEED: products (sample menu items)
-- ============================================================
INSERT INTO products (category_id, name, slug, description, price, stock, is_featured) VALUES
    (1, 'Classic Milk Tea',      'classic-milk-tea',      'Our signature creamy milk tea with tapioca pearls.',        75.00,  50, 1),
    (1, 'Brown Sugar Milk Tea',  'brown-sugar-milk-tea',  'Rich milk tea with caramelised brown sugar syrup.',         85.00,  40, 0),
    (1, 'Taro Milk Tea',         'taro-milk-tea',         'Smooth and earthy taro-flavored milk tea.',                 85.00,  35, 0),
    (2, 'Brown Sugar Coffee',    'brown-sugar-coffee',    'Rich coffee topped with brown sugar drizzle.',              95.00,  40, 1),
    (2, 'Americano',             'americano',             'Bold espresso diluted with hot water.',                     80.00,  30, 0),
    (2, 'Cold Brew',             'cold-brew',             'Slow-steeped cold brew coffee, smooth and refreshing.',    100.00,  25, 0),
    (3, 'Lychee Fruit Tea',      'lychee-fruit-tea',      'Refreshing lychee-infused fruit tea with real lychee bits.',80.00,  45, 1),
    (3, 'Passion Fruit Tea',     'passion-fruit-tea',     'Tangy and tropical passion fruit tea.',                     80.00,  40, 0),
    (4, 'Mocha Frappe',          'mocha-frappe',          'Blended mocha frappe with whipped cream topping.',         110.00,  30, 1),
    (4, 'Caramel Frappe',        'caramel-frappe',        'Creamy caramel blended frappe.',                           110.00,  30, 0),
    (5, 'Matcha Latte',          'matcha-latte',          'Japanese-grade matcha blended with steamed milk.',         100.00,  35, 0),
    (5, 'Ube Latte',             'ube-latte',             'Filipino ube latte with a vibrant purple hue.',            100.00,  35, 0),
    (6, 'Hot Chocolate',         'hot-chocolate',         'Rich and velvety hot chocolate.',                           85.00,  20, 0),
    (7, 'Strawberry Soda',       'strawberry-soda',       'Fizzy strawberry-flavoured soda.',                          70.00,  50, 0),
    (8, 'Premium Salted Caramel','premium-salted-caramel','Premium salted caramel drink with gold drizzle.',          130.00,  20, 0);

-- ============================================================
-- SEED: default admin account (password: admin123)
-- ============================================================
INSERT INTO admins (name, email, password) VALUES
    ('Admin', 'admin@juancafe.ph', '$2y$12$9HVIjAa7J8LXw.OzOQ8qX.hXNTpH4GUKjHKBqxoJyQDYJwXeJiJDy');

-- NOTE: Change the admin password immediately after first login.
-- Generate a new hash with: password_hash('yourpassword', PASSWORD_BCRYPT, ['cost'=>12])