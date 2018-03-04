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
INSERT INTO states (state) VALUES ('Not paid'), ('Paid'), ('Shipped');
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
    UPDATE orders SET orders.state=newstate WHERE orders.id=oid;
  END //
