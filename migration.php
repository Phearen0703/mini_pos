<?php 

    include($_SERVER['DOCUMENT_ROOT']."/mini_pos/config.php");

    const CREATE_TABLE_USER = "CREATE TABLE IF NOT EXISTS users(
        id int not null auto_increment primary key,
        name varchar(100) not null,
        username varchar(100) not null,
        password varchar(100) not null,
        photo varchar(255) null
    )";


    const CREATE_TABLE_CUSTOMERS = "CREATE table IF NOT EXISTS customers(
        id int not null auto_increment primary key,
        name varchar(100) not null,
        photo varchar(255) null
    )";


    const UPDATE_TABLE_PRODUCT_CATEGORIES = "CREATE table IF NOT EXISTS product_categories(
        id int not null auto_increment primary key,
        name varchar(100) not null,
        photo varchar(255) null
    )";


        const UPDATE_TABLE_PRODUCT = "CREATE table IF NOT EXISTS products(
            id int not null auto_increment primary key,
            product_category_id int not null,
            name varchar(100) not null,
            price float(15,2) not null,
            photo varchar(255) null,
            created_at  timestamp not null,
            created_by int not null,
            updated_at timestamp null,
            updated_by int null,
            deleted_at timestamp null,
            deleted_by int null
        )";



        const UPDATE_TABLE_PRODUCT_ORDERS = "CREATE table IF NOT EXISTS product_orders(
            id int not null auto_increment primary key,
            customer_id int not null,
            inv_code varchar(255) not null,
            grand_total float(15,2) not null,
            active int not null default 1 comment '1:active, 0:delete',
            created_at timestamp not null,
            created_by int not null,
            updated_at timestamp null,
            updated_by int null,
            deleted_at timestamp null,
            deleted_by int null
        )";


        const UPDATE_TABLE_PRODUCT_ORDER_DETAILS = "CREATE table IF NOT EXISTS product_order_details(
            id int not null auto_increment primary key,
            product_order_id varchar(255) not null,
            product_id int not null,
            price float(15,2) not null,
            qty float(15,2) not null,
            total float(15,2) not null
        )";

        $conn->query(CREATE_TABLE_USER);
        $conn->query(CREATE_TABLE_CUSTOMERS);
        $conn->query(UPDATE_TABLE_PRODUCT_CATEGORIES);
        $conn->query(UPDATE_TABLE_PRODUCT);
        $conn->query(UPDATE_TABLE_PRODUCT_ORDERS);
        $conn->query(UPDATE_TABLE_PRODUCT_ORDER_DETAILS);

?>