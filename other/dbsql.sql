use krustyKookies;

SET foreign_key_checks = 0;
DROP TABLE IF EXISTS ingredients;
DROP TABLE IF EXISTS recipes;
DROP TABLE IF EXISTS ingredientsInRecipes;
DROP TABLE IF EXISTS pallets;
DROP TABLE IF EXISTS customers;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS superUsers;
DROP TABLE IF EXISTS materialAndRecipeUsers 
DROP TABLE IF EXISTS productionUsers 
DROP TABLE IF EXISTS orderAndDeliveryUsers 
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
	userName varchar(20),
	passWord varchar(60),
	PRIMARY KEY(username)
);

create table superusers (
	id int NOT NULL AUTO_INCREMENT,
	userName varchar(20),
	PRIMARY KEY(id, userName),
	FOREIGN KEY(userName) REFERENCES users(userName)
);

create table materialAndRecipeUsers (
	id int NOT NULL AUTO_INCREMENT,
	userName varchar(20),
	PRIMARY KEY(id, userName),
	FOREIGN KEY(userName) REFERENCES users(userName)
);

create table productionUsers (
	id int NOT NULL AUTO_INCREMENT,
	userName varchar(20),
	PRIMARY KEY(id, userName),
	FOREIGN KEY(userName) REFERENCES users(userName)
);

create table orderAndDeliveryUsers (
	id int NOT NULL AUTO_INCREMENT,
	userName varchar(20),
	PRIMARY KEY(id, userName),
	FOREIGN KEY(userName) REFERENCES users(userName)
);