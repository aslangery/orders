CREATE DATABASE IF NOT EXISTS orders;
USE orders;
CREATE TABLE IF NOT EXISTS users(
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(40),
  email VARCHAR(100),
  password VARCHAR(32)
);

  CREATE TABLE IF NOT EXISTS sessions(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    user_id INTEGER NOT NULL,
    session_id VARCHAR(32)
  );

CREATE TABLE IF NOT EXISTS states(
  id INT PRIMARY KEY AUTO_INCREMENT,
  state VARCHAR(10)
);
INSERT INTO states (state) VALUES ('Not paid'), ('Paid'), ('Shipped'), ('Deleted');
CREATE TABLE IF NOT EXISTS orders(
  id INT AUTO_INCREMENT PRIMARY KEY,
  user INT,
  nomer INT,
  amount DECIMAL(8,2),
  paid DATETIME,
  created DATETIME,
  state INT
);


DELIMITER //

DROP PROCEDURE IF EXISTS changeState;
CREATE PROCEDURE changeState(IN oid INT, IN newstate INT)
  BEGIN
    IF newstate=2 THEN
    UPDATE orders SET orders.state=newstate, orders.paid = NOW() WHERE orders.id=oid;
    END IF;
    UPDATE orders SET orders.state=newstate WHERE orders.id=oid;
  END //

DROP PROCEDURE IF EXISTS getOrder;
CREATE PROCEDURE getOrder (IN oid INT)
  BEGIN
    DECLARE id INT;
    DECLARE username VARCHAR(100);
    DECLARE nomer INT;
    DECLARE amount DECIMAL(8,2);
    DECLARE paid DATETIME;
    DECLARE created DATETIME;
    DECLARE state VARCHAR(10);
    SELECT o.id, u.email, o.nomer, o.amount,
      o.paid, o.created, s.state
    INTO id, username, nomer, amount, paid, created, state
    FROM orders AS o
      LEFT JOIN users AS u ON u.id=o.user
      LEFT JOIN states AS s ON s.id=o.state
    WHERE o.id=oid;
    SELECT id, username, nomer, amount, paid, created, state;
  END //
