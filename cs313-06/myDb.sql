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
    house_id INTEGER NOT NULL REFERENCES houses(id) ON DELETE CASCADE,
    date_added timestamp default now()
);

CREATE TABLE employees (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    house_id INTEGER NOT NULL REFERENCES houses(id) ON DELETE CASCADE 
);

CREATE TABLE employee_reviews (
    id BIGSERIAL PRIMARY KEY,
    score INTEGER NOT NULL,
    employee_id INTEGER NOT NULL REFERENCES employees(id) ON DELETE CASCADE,
    date_added timestamp default now()
);

ALTER TABLE houses ADD picture VARCHAR(1000); 

INSERT INTO houses (name, address, picture) VALUES ('Tuscany', '440 S 2nd W', 'https://thedealio.org/rexburgapartment/wp-content/uploads/sites/6/2016/12/iyzI2ibER5atSaMZmTzA_n1236.jpg' );
INSERT INTO houses (name, address, picture) VALUES ('Mountain Lofts', '538 S 2nd W', 'https://i.ytimg.com/vi/qVRlw1gAzJs/hqdefault.jpg' );
INSERT INTO houses (name, address, picture) VALUES ('Windsor Manor', '538 FOO BAR Dr', 'http://thewindsormanor.com/wp-content/uploads/2015/09/IMG_7399_41-1024x683.jpg' );
INSERT INTO houses (name, address, picture) VALUES ('Viking Village', '2 Harvard St', 'https://www.liveherehousing.com/photos/n1254.jpg' );
INSERT INTO houses (name, address, picture) VALUES ('Windoor Manor', '555 FOO BAR Dr', 'http://thewindsormanor.com/wp-content/uploads/2015/09/IMG_7399_41-1024x683.jpg' );

INSERT INTO house_reviews (score, recommended, commentary, house_id) VALUES (5, true, 'I love it here. The maintenence team is superb and personal rooms is also an appreciated feature.', 1);

INSERT INTO house_reviews (score, recommended, commentary, house_id) VALUES (1, false, 'THE MANAGEMENT DOESNT CARE ABOUT ANYONE OR ANYTHING EXCEPT MAKING MONEY.', 1);

INSERT INTO house_reviews (score, recommended, commentary, house_id) VALUES (3, true, 'I like the housing but there is too much noise in the halls. I recommend it but beware.', 2);

INSERT INTO house_reviews (score, recommended, commentary, house_id) VALUES (5, true, 'All I''ll say is that if they turned out to have filmed Harry Potter here, I wouldn''t be surprised.', 3);

INSERT INTO house_reviews (score, recommended, commentary, house_id) VALUES (1, false, 'I came back from school one day to catch my roommates performing a human sacrifice. The clean checks are also kinda strict.', 4);

INSERT INTO employees (name, house_id) values ('Sammy', 1);
INSERT INTO employees (name, house_id) values ('Hannah', 1);
INSERT INTO employees (name, house_id) values ('Danielle', 2);

INSERT INTO employee_reviews (score, employee_id) values (5, 7);
INSERT INTO employee_reviews (score, employee_id) values (4, 7);
INSERT INTO employee_reviews (score, employee_id) values (2, 9);


CREATE USER reader_viewer WITH PASSWORD '123456';
GRANT SELECT, INSERT ON ALL TABLES IN SCHEMA public TO reader_viewer;
GRANT USAGE, SELECT ON ALL SEQUENCES IN SCHEMA public TO reader_viewer;


/* Practice queries. Not meant to create the database */

/* Here's a Query for the average ratings with employees */
SELECT * FROM employees
LEFT JOIN (SELECT employee_id, trunc(avg(score), 1) FROM employee_reviews GROUP BY employee_id) AS foo
ON employees.id = foo.employee_id WHERE employees.house_id = 1;

SELECT * FROM houses
LEFT JOIN (SELECT house_id, trunc(avg(score), 1) FROM house_reviews GROUP BY house_id) AS r
ON houses.id = r.house_id;


/* Clear all tables */
CREATE OR REPLACE FUNCTION clear() RETURNS integer AS $$
DECLARE
    i integer = 0;
    r RECORD;
BEGIN
    FOR r IN (SELECT tablename FROM pg_tables WHERE schemaname = current_schema()) LOOP
        RAISE NOTICE 'DROP TABLE IF EXISTS % CASCADE;', r.tablename;
        EXECUTE 'DROP TABLE IF EXISTS ' || quote_ident(r.tablename) || ' CASCADE;';
        i := i + 1;
    END LOOP;
    
    IF i = 0 THEN
        RAISE NOTICE 'No tables to drop.';
    END IF;
    
    RETURN i;
END;
$$ LANGUAGE plpgsql;
-- SELECT clear();