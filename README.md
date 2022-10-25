# A ELibrary website developed with PHP and MySQL

## How to run (with xampp)

Clone the repository:
- ``git clone https://github.com/GuysKapen/ELibraryPHP``

Move the project into xampp htdocs and rename to web
- ``cd htdocs``
- ``mv <path-to-project> web``

Import sample data:
- Go to phpMyAdmin
- Create database name `web`
- Import `web.sql` from the project

##### Note: If import web.sql failed try to replace all COLLATE=utf8mb4_0900_ai_ci into your suitable COLLATE (depend on your OS and MySQL version)

Modify credentials in connect.php to connect to MySQL

That it, open http://localhost/web/ and enjoy