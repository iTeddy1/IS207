<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $DBName = "qlks";
    $conn = mysqli_connect($servername, $username, $password, $DBName) Or die("<p> Không thế connect</p>"."<p> Eror code: ".mysqli_connect_errno().":".mysqli_connect_error()."</p>");

    mysqli_set_charset($conn, "utf8");
