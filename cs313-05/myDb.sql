CREATE DATABASE house_ratings ;

\connect house_ratings

CREATE TABLE houses (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    address TEXT NOT NULL
);

CREATE TABLE house_reviews (
    id BIGSERIAL PRIMARY KEY,
    score INTEGER NOT NULL,
    recommended BOOLEAN NOT NULL,
    commentary VARCHAR(2000) NOT NULL,
    house_id INTEGER REFERENCES houses(id) NOT NULL,
    date_added timestamp default now()
);

CREATE TABLE employees (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    house_id INTEGER REFERENCES houses(id) NOT NULL
);

CREATE TABLE employee_reviews (
    id BIGSERIAL PRIMARY KEY,
    score INTEGER NOT NULL,
    employee_id INTEGER REFERENCES employees(id) NOT NULL,
    date_added timestamp default now()
);