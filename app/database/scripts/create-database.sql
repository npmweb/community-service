-- edit to specify your own DB name, etc
CREATE DATABASE l_commsvc;

GRANT ALL PRIVILEGES
  ON l_commsvc.*
  TO 'l_commsvc'@'localhost'
  IDENTIFIED BY 'l_commsvc'
  WITH GRANT OPTION;
