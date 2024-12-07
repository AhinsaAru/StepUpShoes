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

    // Validate input
    if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['brand']) && isset($_POST['category']) && isset($_POST['type']) && isset($_POST['description']) && isset($_POST['material']) && isset($_POST['color']) && isset($_POST['sizes']) && isset($_POST['price'])) {
        
        // Sanitize and validate input
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        if ($id <= 0) {
            throw new Exception("Invalid product ID.");
        }

        $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
        $brand = htmlspecialchars($_POST['brand'], ENT_QUOTES, 'UTF-8');
        $category = htmlspecialchars($_POST['category'], ENT_QUOTES, 'UTF-8');
        $type = htmlspecialchars($_POST['type'], ENT_QUOTES, 'UTF-8');
        $description = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
        $material = htmlspecialchars($_POST['material'], ENT_QUOTES, 'UTF-8');
        $color = htmlspecialchars($_POST['color'], ENT_QUOTES, 'UTF-8');
        
        $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        if ($price <= 0) {
            throw new Exception("Price must be a positive number.");
        }

        $stock = isset($_POST['stock']) ? filter_var($_POST['stock'], FILTER_SANITIZE_NUMBER_INT) : 0;
        if ($stock < 0) {
            throw new Exception("Stock cannot be negative.");
        }
        
        $image_url = "";

        // Handle sizes
        $sizes = $_POST['sizes'];
        $sizes = array_map(function ($size) {
            $decodedSize = is_array($size) ? $size : json_decode($size, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Invalid JSON in sizes: ' . json_last_error_msg());
            }
            return $decodedSize;
        }, $sizes);

        // Handle image
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $imageInfo = getimagesize($_FILES['image']['tmp_name']);
            if ($imageInfo !== false) {
                $imageName = $_FILES['image']['name'];
                $imagePath = "../resources/" . $imageName;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                    $image_url = "resources/" . $imageName;
                } else {
                    throw new Exception("Failed to move uploaded image");
                }
            } else {
                throw new Exception("Uploaded file is not an image");
            }
        }

        // Set the product data
        $product->setId($id);
        $product->setTitle($title);
        $product->setBrand($brand);
        $product->setCategory($category);
        $product->setType($type);
        $product->setDescription($description);
        $product->setMaterial($material);
        $product->setColor($color);
        $product->setSizes($sizes);
        $product->setPrice($price);
        $product->setImageUrl($image_url);
        $product->setStock($stock);

        // Update the product
        if ($product->updateProduct() !== true) {
            throw new Exception("Failed to update the product");
        }

        // Return the response as JSON
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode(["message" => "Product updated successfully"], JSON_PRETTY_PRINT);
    } else {
        throw new Exception("All required fields are not provided");
    }
} catch (Exception $e) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode(["error" => $e->getMessage()], JSON_PRETTY_PRINT);
}
