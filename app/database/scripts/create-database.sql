-- edit to specify your own DB name, etc
CREATE DATABASE l_myappname;

GRANT ALL PRIVILEGES
  ON l_myappname.*
  TO 'l_myappname'@'localhost'
  IDENTIFIED BY 'l_myappname'
  WITH GRANT OPTION;
