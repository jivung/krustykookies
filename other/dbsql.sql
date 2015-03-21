use krustyKookies;

SET foreign_key_checks = 0;
DROP TABLE IF EXISTS ingredients;
DROP TABLE IF EXISTS recipes;
DROP TABLE IF EXISTS ingredientsInRecipes;
DROP TABLE IF EXISTS pallets;
DROP TABLE IF EXISTS customers;
DROP TABLE IF EXISTS users;
SET foreign_key_checks = 1;

CREATE TABLE ingredients(
	name VARCHAR(30),
	amount INT,
	lastDeliveryDate DATE,
	lastDeliveryAmount INT,
	PRIMARY KEY(name)
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
	deliveryDate DATE,
	customerName VARCHAR(30),
	PRIMARY KEY(id),
	FOREIGN KEY(recipeName) REFERENCES recipes(name),
	FOREIGN KEY(customerName) REFERENCES customers(name)
);

CREATE TABLE users (
	id int NOT NULL AUTO_INCREMENT,
	userName VARCHAR(20) NOT NULL,
	passWord VARCHAR(60) NOT NULL,
	isSuperUser TINYINT(1) DEFAULT 0,
	isMaterialUser TINYINT(1) DEFAULT 0,
	isProductionUser TINYINT(1) DEFAULT 0,
	isOrderUser TINYINT(1) DEFAULT 0,
	PRIMARY KEY(id)
);