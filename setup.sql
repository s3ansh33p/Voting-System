-- Sean McGinty <newfolderlocation@gmail.com> 23/07/2021

CREATE DATABASE IF NOT EXISTS voting;
USE voting;

-- Categories Table
CREATE TABLE IF NOT EXISTS categories (
    id int(8) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    catName text(32) NOT NULL,
    added timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Insert null category
INSERT INTO categories (id, catName) VALUES (0, 'UNDEF');

-- Nominations Table
CREATE TABLE IF NOT EXISTS nominations (
    id int(8) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nomName text(255) NOT NULL,
    nomCat int(8) NOT NULL DEFAULT 0,
    added timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Insert null nomination
INSERT INTO nominations (id, nomName, nomCat) VALUES (0, 'UNDEF', 0);

-- Users Table -> Discord oAuth
CREATE TABLE IF NOT EXISTS users (
    id int(8) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    userid int (16) NOT NULL,
    username text(32) NOT NULL,
    discriminator text(4) NOT NULL,
    avatar text(255),
    added timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    isAdmin tinyint(1) NOT NULL DEFAULT 0
);

-- Votes Table
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
    added timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);
