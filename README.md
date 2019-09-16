# University Olympic Registration System
## How to Setup on localhost
The platform uses CodeIgniter as the framework, so be sure to have Apache server running. To run the server, you can use XAMPP or Docker.
### Setup DB
Create a MySQL database schema on your local named `olympic_registration_schema` and import `olympic_registration_schema.sql` that can be found in `/db/schema`.
To easily check if the web app is already connected to the database, you can open the registration page from menu `Daftar` and check if the faculty field is filled with lists of faculty name.
### Run App using Docker
1. Before building the image and run the container, check the DB configuration for the app first by opening `Dockerfile`. Change the `DOCKER_HOST_IP` value to your host IP. It can be found by executing `ipconfig` on terminal and find `inet` value of `en0`, or executing `ipconfig getifaddr en0` to get the IP directly. (This is necessary because Docker creates new environment for the app, and you need to connect your app that is placed in different environment with your local database.)
2. Check also the other values set as environment variables in `Dockerfile`, and make sure those match your DB configuration.
3. Open your terminal and make sure you're on the project root (on the same level with `docker-compose.yml` file), then execute command `docker-compose up -d`.
#### Failed to connect to DB?
If you fail to connect (you can check it by opening the registration page and the error will show), then try to check your MySQL user table and see if user `root` has wildcard symbol (%) as the host value by executing `SELECT host, user FROM MYSQL.USER;` on MySQL command line. The result will be like this:
```
+-----------+------------------+
| host      | user             |
+-----------+------------------+
| %         | root             |
| localhost | mysql.infoschema |
| localhost | mysql.session    |
| localhost | mysql.sys        |
+-----------+------------------+
```
If your `root` does not have wildcard, or maybe `localhost` instead of %, it means that the DB won't accept connections other than local connection. Update the value by executing `UPDATE MYSQL.USER SET host='%' WHERE user='root';`, then `GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' WITH GRANT OPTION;`.

### Run App using XAMPP
1. Set all environment variables on your local manually and change the `HOSTNAME_IP` value to `localhost`, because you're running it on the same environment (same steps as using Docker).
2. Also change and make sure the port used in `BASE_URL` value is the same as `http` port on your local (you can check the port on XAMPP Control Panel, by default it's listening on 80).
3. Open XAMPP Control Panel.
4. Run Apache and MySQL from the control panel.
5. Open the web browser and type the base url.