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
	deliveryDate INT(11),
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
	PRIMARY KEY(orderId),
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

INSERT INTO recipes(name) VALUES("Nut Ring");
INSERT INTO recipes(name) VALUES("Nut Cookie");
INSERT INTO recipes(name) VALUES("Amneris");
INSERT INTO recipes(name) VALUES("Tango");
INSERT INTO recipes(name) VALUES("Almond delight");
INSERT INTO recipes(name) VALUES("Berliner");

INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Nut Ring", "Flour", 450);
INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Nut Ring", "Butter", 450);
INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Nut Ring", "Icing_sugar", 190);
INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Nut Ring", "Roasted_chopped_nuts", 225);

INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Nut cookie", "Fine-ground_nuts", 750);
INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Nut cookie", "Ground_roasted_nuts", 625);
INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Nut cookie", "Bread_crumbs", 125);
INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Nut cookie", "Sugar", 375);
INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Nut cookie", "Egg_whites", 350);
INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Nut cookie", "Chocolate", 50);

INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Amneris", "Marzipan", 750);
INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Amneris", "Butter", 250);
INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Amneris", "Eggs", 250);
INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Amneris", "Potato_starch", 25);
INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Amneris", "Wheat_flour", 25);

INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Tango", "Butter", 200);
INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Tango", "Sugar", 270);
INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Tango", "Flour", 300);
INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Tango", "Sodium_bicarbonate", 4);
INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Tango", "Vanilla", 2);

INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Almond delight", "Butter", 400);
INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Almond delight", "Sugar", 270);
INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Almond delight", "Chopped_almonds", 279);
INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Almond delight", "Flour", 400);
INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Almond delight", "Cinnamon", 10);

INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Berliner", "Flour", 350);
INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Berliner", "Butter", 250);
INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Berliner", "Icing_sugar", 100);
INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Berliner", "Eggs", 50);
INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Berliner", "Vanilla_sugar", 5);
INSERT INTO ingredientsInRecipes(recipeName, ingredientName, amount) VALUES ("Berliner", "Chocolate", 50);

