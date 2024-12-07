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
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Method not allowed");
    }

    // Get the product id
    $id = $_POST['id'] ?? null;

    // Set the product id
    $product->setId($id);

    // Delete the product
    if ($product->deleteProduct() !== true) {
        throw new Exception("Failed to delete the product");
    }

    // Return the response as JSON
    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode(["message" => "Product deleted successfully"], JSON_PRETTY_PRINT);
} catch (Exception $e) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode(["error" => $e->getMessage()], JSON_PRETTY_PRINT);
}