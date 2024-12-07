<?php

use App\Classes\DbConnector;
use App\Classes\Product;

require_once("../classes/DbConnector.php");
require_once("../classes/Product.php");

try {
    // Get the database connection
    $db = new DbConnector();
    $product = new Product();

    // Set the database connection for the product
    $product->setCon($db->getConnection());

    // Check request method
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        throw new Exception("Method not allowed");
    }

    // Get all the products
    $products = $product->getAllProducts();

    // Return the products as JSON
    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode($products, JSON_PRETTY_PRINT);
} catch (Exception $e) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode(["error" => $e->getMessage()], JSON_PRETTY_PRINT);
}