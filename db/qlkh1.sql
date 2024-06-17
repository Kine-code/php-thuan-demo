-- Create users table
CREATE TABLE users (
  id INT PRIMARY KEY IDENTITY(1,1),
  name VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  choose varchar(255) NOT NULL,
  reset_token varchar(255) DEFAULT NULL,
  created_at DATETIME DEFAULT GETDATE(),
  updated_at DATETIME
);
-- Create products table
CREATE TABLE products (
  id INT PRIMARY KEY IDENTITY(1,1),
  name VARCHAR(255) NOT NULL,
  price DECIMAL(10, 2) NOT NULL,
  image VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT GETDATE(),
  updated_at DATETIME
);

-- Create contacts table
CREATE TABLE contacts (
  id INT PRIMARY KEY IDENTITY(1,1),
  user_id INT NOT NULL,
  full_name VARCHAR(250) NOT NULL,
  email VARCHAR(255) NOT NULL,
  phone_number VARCHAR(20),
  message TEXT,
  created_at DATETIME DEFAULT GETDATE(),
  updated_at DATETIME,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Create carts table
CREATE TABLE carts (
  id INT PRIMARY KEY IDENTITY(1,1),
  user_id INT NOT NULL,
  product_id INT NOT NULL,
  price varchar(255) NOT NULL,
  qty varchar(255) NOT NULL,
  created_at DATETIME DEFAULT GETDATE(),
  updated_at DATETIME,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE orders (
  id varchar(20) NOT NULL,
  user_id INT NOT NULL,
  name varchar(255) NOT NULL,
  number varchar(10) NOT NULL,
  email varchar(255) NOT NULL,
  address_type varchar(255) NOT NULL,
  method varchar(200) NOT NULL,
   product_id INT NOT NULL,
  price varchar(200) NOT NULL,
  qty varchar(200) NOT NULL,
  date date NOT NULL DEFAULT current_timestamp,
  status varchar(200) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (product_id) REFERENCES products(id)
)