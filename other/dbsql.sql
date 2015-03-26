use krustyKookies;

SET foreign_key_checks = 0;
DROP TABLE IF EXISTS ingredients;
DROP TABLE IF EXISTS recipes;
DROP TABLE IF EXISTS ingredientDelivery;
DROP TABLE IF EXISTS ingredientsInRecipes;
DROP TABLE IF EXISTS pallets;
DROP TABLE IF EXISTS customers;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS customerInfo;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS numPallets;
SET foreign_key_checks = 1;

CREATE TABLE ingredients(
	name VARCHAR(30),
	amount INT,
	PRIMARY KEY(name)
);

CREATE TABLE ingredientDelivery(
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(30),
	amount INT,
	deliveryTime INT(11) NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(name) REFERENCES ingredients(name)
);

CREATE TABLE recipes(
	name VARCHAR(30),
	PRIMARY KEY(name)
);

CREATE TABLE ingredientsInRecipes(
	recipeName VARCHAR(30),
	ingredientName VARCHAR(30),
	amount INT,
	PRIMARY KEY(recipeName, ingredientName),
	FOREIGN KEY(recipeName) REFERENCES recipes(name),
	FOREIGN KEY(ingredientName) REFERENCES ingredients(name)
);

CREATE TABLE customers(
	name VARCHAR(30),
	address VARCHAR(30),
	PRIMARY KEY(name)
);

CREATE TABLE pallets(
	id INT NOT NULL AUTO_INCREMENT,
	recipeName VARCHAR(30),
	location VARCHAR(30),
	isBlocked TINYINT(1),
	deliveryDate INT(11) NOT NULL,
	customerName VARCHAR(30),
	PRIMARY KEY(id),
	FOREIGN KEY(recipeName) REFERENCES recipes(name),
	FOREIGN KEY(customerName) REFERENCES customers(name)
);

CREATE TABLE users(
	id INT NOT NULL AUTO_INCREMENT,
	userName VARCHAR(20) NOT NULL UNIQUE,
	passWord VARCHAR(60) NOT NULL,
	isSuperUser TINYINT(1) DEFAULT 0,
	isAdmin TINYINT(1) DEFAULT 0,
	isMaterialUser TINYINT(1) DEFAULT 0,
	isProductionUser TINYINT(1) DEFAULT 0,
	isOrderUser TINYINT(1) DEFAULT 0,
	isCustomer TINYINT(1) DEFAULT 0,
	PRIMARY KEY(id)
);

CREATE TABLE customerInfo(
	id INT NOT NULL AUTO_INCREMENT,
	userName VARCHAR(20) NOT NULL UNIQUE,
	fullName VARCHAR(30) NOT NULL UNIQUE,
	address VARCHAR(30) NOT NULL,
	PRIMARY KEY(id, userName),
	FOREIGN KEY(userName) REFERENCES users(userName)
);

CREATE TABLE orders(
	id INT NOT NULL AUTO_INCREMENT,
	customer VARCHAR(20),
	orderTime INT(11) NOT NULL,
	deliveryDate INT(11) NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(customer) references customerInfo(userName)
);

CREATE TABLE numPallets(
	orderId INT NOT NULL,
	recipeName VARCHAR(30),
	numPallets INT(11) DEFAULT 0,
	PRIMARY KEY(id),
	FOREIGN KEY(orderId) REFERENCES orders(id),
	FOREIGN KEY(recipeName) REFERENCES recipes(name)
);

INSERT INTO ingredients VALUES ("Flour", 100000);
INSERT INTO ingredients VALUES ("Butter", 100000);
INSERT INTO ingredients VALUES ("Icing_sugar", 100000);
INSERT INTO ingredients VALUES ("Roasted_chopped_nuts", 100000);
INSERT INTO ingredients VALUES ("Fine-ground_nuts", 100000);
INSERT INTO ingredients VALUES ("Ground_roasted_nuts", 100000);
INSERT INTO ingredients VALUES ("Bread_crumbs", 100000);
INSERT INTO ingredients VALUES ("Sugar", 100000);
INSERT INTO ingredients VALUES ("Egg_whites", 100000);
INSERT INTO ingredients VALUES ("Chocolate", 100000);
INSERT INTO ingredients VALUES ("Marzipan", 100000);
INSERT INTO ingredients VALUES ("Eggs", 100000);
INSERT INTO ingredients VALUES ("Potato_starch", 100000);
INSERT INTO ingredients VALUES ("Wheat_flour", 100000);
INSERT INTO ingredients VALUES ("Sodium_bicarbonate", 100000);
INSERT INTO ingredients VALUES ("Vanilla", 100000);
INSERT INTO ingredients VALUES ("Chopped_almonds", 100000);
INSERT INTO ingredients VALUES ("Cinnamon", 100000);
INSERT INTO ingredients VALUES ("Vanilla_sugar", 100000);