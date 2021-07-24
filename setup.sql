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

-- Insert voting categories
INSERT INTO categories (catName, descriptor) VALUES ('Best Scene', 'What do you think was the best scene'), ('Best Character', 'Who do you think was the best character');

-- Nominations Table
CREATE TABLE IF NOT EXISTS nominations (
    id int(8) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nomName text(255) NOT NULL,
    nomCat int(8) NOT NULL DEFAULT 0,
    added timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Insert voting nominations
INSERT INTO nominations (nomName, nomCat) VALUES ('Some Scene I', 1), ('Another Scene II', 1), ('Another Scene III', 1), ('Another Scene V', 1), ('Another Scene V', 1), ('Another Scene VI', 1), ('Another Scene VII', 1);

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