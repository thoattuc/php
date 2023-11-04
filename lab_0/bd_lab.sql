create database `db_lab`;

use db_lab;

CREATE TABLE roles (
    id int auto_increment PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT current_timestamp
);

CREATE TABLE users (
    id int auto_increment PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email varchar(255) not null,
    password varchar(255) not null,
    status tinyint default 1,
    role_id INT,
    created_at TIMESTAMP DEFAULT current_timestamp,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);
