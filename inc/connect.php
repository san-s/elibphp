<?php 
$con = mysqli_init();
mysqli_ssl_set($con,NULL,NULL, "{path to CA cert}", NULL, NULL);
mysqli_real_connect($conn, "elibrary1.mysql.database.azure.com", "cloudsec", "Test@123", "web", 3306, MYSQLI_CLIENT_SSL);
}
