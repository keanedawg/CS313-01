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

ALTER TABLE houses
ADD picture VARCHAR(1000); 

UPDATE houses 
SET picture = 'https://thedealio.org/rexburgapartment/wp-content/uploads/sites/6/2016/12/iyzI2ibER5atSaMZmTzA_n1236.jpg';

INSERT INTO house_reviews (score, recommended, commentary, house_id)
VALUES (5, true, 'I love it here. The maintenence team is superb and personal rooms is also an appreciated feature.', 1);

INSERT INTO house_reviews (score, recommended, commentary, house_id)
VALUES (1, false, 'THE MANAGEMENT DOESNT CARE ABOUT ANYONE OR ANYTHING EXCEPT MAKING MONEY.', 1);

INSERT INTO house_reviews (score, recommended, commentary, house_id)
VALUES (3, false, 'I like the housing but there is too much noise in the halls. I recommend it but beware.', 2);

INSERT INTO employees (name, house_id) values ('Sammy', 1);
INSERT INTO employees (name, house_id) values ('Hannah', 1);
INSERT INTO employees (name, house_id) values ('Danielle', 2);

INSERT INTO employee_reviews (score, employee_id) values (5, 1);
INSERT INTO employee_reviews (score, employee_id) values (4, 1);
INSERT INTO employee_reviews (score, employee_id) values (2, 3);