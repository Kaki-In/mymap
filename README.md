# mymap
An online public maps area (didn't finished yet). 

## Installation
### 1. Download
Run the following command in your server (in the directory where you want to install the map):
```bash
git clone https://www.github.com/Kaki-In/worldMap
```

### 2. Set up the SQL environment
Import the `init.sql` file in your own database. 

## Configuration

To configure the area, open the `conf.php` project and modify the different values written:
 - `database-name` : the name of your database (default `mymap`)
 - `database-server` : the server that hosts your database (default `localhost`)
 - `database-user` : the username of your database (default `root`)
 - `database-password` : the password of your database
 - `pathname` : the path from your site root to the directory that contains the maps area (ex : `"/games/mymap"`)

## Results
