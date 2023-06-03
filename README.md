# TGO 21 Projektarbeit IV
Composer required! -> https://getcomposer.org

## Deployment
Move the code into a webserver directory e.g xampp or nginx

```bash
  composer install
```

Prepare database and check the connection information in /backend/includes/db.inc.php

Create the required table
```bash
  CREATE TABLE shopping_lists (id INT AUTO_INCREMENT NOT NULL, note TEXT, list TEXT, created_at INT, PRIMARY KEY (id))
```

##

Dockerfile for containerisation prepared, see Dockerfile