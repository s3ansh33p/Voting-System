-- Sean McGinty <newfolderlocation@gmail.com> 24/07/2021

CREATE DATABASE IF NOT EXISTS voting;
USE voting;

-- Categories Table
CREATE TABLE IF NOT EXISTS categories (
    id int(8) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    catName text(32) NOT NULL,
    descriptor text(255),
    added timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Nominations Table
CREATE TABLE IF NOT EXISTS nominations (
    id int(8) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nomName text(255) NOT NULL,
    nomCat int(8) NOT NULL DEFAULT 0,
    added timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Users Table -> Discord oAuth
CREATE TABLE IF NOT EXISTS users (
    id bigint(8) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    username text(32) NOT NULL,
    discriminator text(4) NOT NULL,
    avatar text(32),
    added timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    isAdmin tinyint(1) NOT NULL DEFAULT 0
);

-- Votes Table (Always 7 nominations per category so I can be lazy)
CREATE TABLE IF NOT EXISTS votes (
    id int(8) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nomCat int (8) NOT NULL,
    nomName1 int (8) NOT NULL DEFAULT 0,
    nomName2 int (8) NOT NULL DEFAULT 0,
    nomName3 int (8) NOT NULL DEFAULT 0,
    nomName4 int (8) NOT NULL DEFAULT 0,
    nomName5 int (8) NOT NULL DEFAULT 0,
    nomName6 int (8) NOT NULL DEFAULT 0,
    nomName7 int (8) NOT NULL DEFAULT 0,
    added timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    userid bigint(8) NOT NULL
);

-- Insert voting categories
INSERT INTO categories (catName, descriptor) VALUES ('Best Scene', 'What do you think was the best scene'), ('Best Character', 'Who do you think was the best character');

-- Insert voting nominations
INSERT INTO nominations (nomName, nomCat) VALUES ('Some Scene I', 1), ('Another Scene II', 1), ('Another Scene III', 1), ('Another Scene IV', 1), ('Another Scene V', 1), ('Another Scene VI', 1), ('Another Scene VII', 1);
INSERT INTO nominations (nomName, nomCat) VALUES ('Some Actor I', 2), ('Another Actor II', 2), ('Another Actor III', 2), ('Another Actor IV', 2), ('Another Actor V', 2), ('Another Actor VI', 2), ('Another Actor VII', 2);

-- Insert test users
INSERT INTO users (id, username, discriminator, avatar) VALUES ('1337', 'test', '0001', '1337'), ('1338', 'tester', '0003', '1338'), ('1339', 'bob', '2301', '1339');

-- Insert test votes
INSERT INTO votes (nomCat, nomName1, nomName2, nomName3, nomName4, nomName5, nomName6, nomName7, userid) VALUES ('1', '1', '2', '3', '4', '5', '6', '7', '1337'), ('1', '1', '2', '3', '7', '5', '4', '6', '1338'), ('1', '4', '2', '3', '1', '5', '6', '7', '1339');
