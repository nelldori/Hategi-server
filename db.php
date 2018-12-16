<?php

/*
 * Database connection
 */

require_once "./config.php";

class db {
    private static $conn;

    //conn - connect to MYSQL
    //to make life easier for first time developers this function automatically creates the database & table if they are missing
    // 디비에 연결, 자동으로 디비를 만들어줌
    public static function conn() {
        self::$conn = new mysqli(global_val("servername"), global_val("username"), global_val("password"));

        // Check connection
        if (self::$conn->connect_error) {
            die("Connection failed: " . self::$conn->connect_error);
        }

        //check if we need to create the database
        self::create_database();
        self::$conn->select_db(global_val("databasename"));
        //check if we need to create tables
        self::create_tables();

        return self::$conn;
    }
    //end conn

    //create_database
    //디비생성
    private static function create_database() {
        self::$conn->query("CREATE DATABASE IF NOT EXISTS " . global_val("databasename")) or die("create_database failed");
    }
    //end create_database

    //create_tables
    //테이블 생성
    // ----------------------------------------------
    // ID, x좌표, y좌표, z좌표, x, y, z, w, 날짜, 상태

    private static function create_tables() {
        $result = self::$conn->query("select * from QUEUE limit 1");
        if(empty($result)) {
            $query = "CREATE TABLE QUEUE (
                          ID INT AUTO_INCREMENT,
                          place_name varchar(15),
                          point_x DOUBLE,
                          point_y DOUBLE,
                          point_z DOUBLE,
                          quat_x DOUBLE,
                          quat_y DOUBLE,
                          quat_z DOUBLE,
                          quat_w DOUBLE,
                          date_created DATETIME,
                          status TINYINT,
                          PRIMARY KEY  (ID)
                          )";
            self::$conn->query($query) or die("create table failed");
        }
    }
    //end create_tables
}
