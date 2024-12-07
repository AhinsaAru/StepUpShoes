<?php

namespace App\Classes;

use DateTime;
use Exception;
use PDO;

/**
 * Class Product
 *
 * Handles product data
 */
class Product
{
    private int $id;
    private string $title;
    private string $brand;
    private string $category;
    private string $type;
    private string $description;
    private string $material;
    private string $color;
    private mixed $size;
    private float $price;
    private int $stock;
    private array $sizes;
    private string $image_url;
    private DateTime $created_at;
    private DateTime $updated_at;
    private PDO $con;

    /**
     * Product constructor.
     *
     * Initialize the product object
     */
    public function __construct()
    {
        // Logic to initialize the product object
    }

    /**
     * Get the product title
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the product title
     *
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Get the product title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the product title
     *
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Get the product brand
     *
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * Set the product brand
     *
     * @param string $brand
     */
    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * Get the product category
     *
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * Set the product category
     *
     * @param string $category
     */
    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    /**
     * Get the product type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set the product type
     *
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * Get the product description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the product description
     *
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Get the product material
     *
     * @return string
     */
    public function getMaterial(): string
    {
        return $this->material;
    }

    /**
     * Set the product material
     *
     * @param string $material
     */
    public function setMaterial(string $material): void
    {
        $this->material = $material;
    }

    /**
     * Get the product color
     *
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * Set the product color
     *
     * @param string $color
     */
    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    /**
     * Get the product size
     *
     * @return mixed
     */
    public function getSize(): mixed
    {
        return $this->size;
    }

    /**
     * Set the product size
     *
     * @param string $size
     */
    public function setSize(string $size): void
    {
        $this->size = $size;
    }

    /**
     * Get the product price
     *
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Set the product price
     *
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * Get the product stock
     *
     * @return int
     */
    public function getStock(): int
    {
        return $this->stock;
    }

    /**
     * Set the product stock
     *
     * @param int $stock
     */
    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }

    /**
     * Get the product sizes
     *
     * @return array
     */
    public function getSizes(): array
    {
        return $this->sizes;
    }

    /**
     * Set the product sizes
     *
     * @param array $sizes
     */
    public function setSizes(array $sizes): void
    {
        $this->sizes = $sizes;
    }

    /**
     * Get the product image
     *
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->image_url;
    }

    /**
     * Set the product image
     *
     * @param string $image_url
     */
    public function setImageUrl(string $image_url): void
    {
        $this->image_url = $image_url;
    }

    /**
     * Get the product created_at
     *
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    /**
     * Set the product created_at
     *
     * @param DateTime $created_at
     */
    public function setCreatedAt(DateTime $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * Get the product updated_at
     *
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updated_at;
    }

    /**
     * Set the product updated_at
     *
     * @param DateTime $updated_at
     */
    public function setUpdatedAt(DateTime $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    /**
     * Get the database connection
     *
     * @param PDO $con
     */
    public function setCon(PDO $con): void
    {
        $this->con = $con;
    }

    /**
     * Get a custom product list from the database
     *
     * @param int|null $limit The number of products to return
     * @return false|array
     */
    public function getCustomProducts(int $limit = null): false|array
    {
        try {
            // Query to get products with sizes
            $query = 'SELECT p.*, ps.size, ps.stock
                  FROM products p
                  LEFT JOIN product_sizes ps ON p.id = ps.product_id
                  ORDER BY p.category, p.id';
            $stmt = $this->con->prepare($query);
            $stmt->execute();

            // Fetch all products
            $rawProducts = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $productId = $row['id'];
                $category = $row['category'];
                if (!isset($rawProducts[$category])) {
                    $rawProducts[$category] = [];
                }
                if (!isset($rawProducts[$category][$productId])) {
                    $rawProducts[$category][$productId] = [
                        'id' => $row['id'],
                        'title' => $row['title'],
                        'brand' => $row['brand'],
                        'category' => $row['category'],
                        'type' => $row['type'],
                        'description' => $row['description'],
                        'material' => $row['material'],
                        'color' => $row['color'],
                        'price' => $row['price'],
                        'image_url' => $row['image_url'],
                        'sizes' => [],
                    ];
                }
                if ($row['size'] !== null) {
                    $rawProducts[$category][$productId]['sizes'][] = [
                        'size' => $row['size'],
                        'stock' => $row['stock']
                    ];
                }
            }

            // Limit the number of products
            $finalProducts = [];
            foreach ($rawProducts as $category => $productList) {
                $productList = array_values($productList);
                if ($limit !== null) {
                    $productList = array_slice($productList, 0, $limit);
                }
                $finalProducts[$category] = $productList;
            }

            return $finalProducts;
        } catch (Exception) {
            return false;
        }
    }

    /**
     * Get all products from the database
     *
     * @return false|array
     */
    public function getAllProducts(): false|array
    {
        try {
            // Query to get all products
            $query = 'SELECT p.*, ps.size, ps.stock
                  FROM products p
                  LEFT JOIN product_sizes ps ON p.id = ps.product_id
                  ORDER BY p.updated_at DESC';
            $stmt = $this->con->prepare($query);
            $stmt->execute();

            // Fetch all products
            $products = [];
            while ($row = $stmt->fetch()) {
                $productId = $row->id;
                if (!isset($products[$productId])) {
                    $products[$productId] = [
                        'id' => $productId,
                        'title' => $row->title,
                        'brand' => $row->brand,
                        'category' => $row->category,
                        'type' => $row->type,
                        'description' => $row->description,
                        'material' => $row->material,
                        'color' => $row->color,
                        'price' => $row->price,
                        'image_url' => $row->image_url,
                        'sizes' => [],
                    ];
                }

                // Add sizes to the product
                if ($row->size !== null) {
                    $products[$productId]['sizes'][] = [
                        'size' => $row->size,
                        'stock' => $row->stock,
                    ];
                }
            }

            return array_values($products);
        } catch (Exception) {
            return false;
        }
    }

    /**
     * Add a new product to the database
     *
     * @return bool
     */
    public function addProduct(): bool
    {
        try {
            // Start the transaction
            $this->con->beginTransaction();

            // Insert into 'products' table
            $query = 'INSERT INTO products (title, brand, category, type, description, material, color, price, image_url) VALUES (:title, :brand, :category, :type, :description, :material, :color, :price, :image_url)';
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindParam(':brand', $this->brand, PDO::PARAM_STR);
            $stmt->bindParam(':category', $this->category, PDO::PARAM_STR);
            $stmt->bindParam(':type', $this->type, PDO::PARAM_STR);
            $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
            $stmt->bindParam(':material', $this->material, PDO::PARAM_STR);
            $stmt->bindParam(':color', $this->color, PDO::PARAM_STR);
            $stmt->bindParam(':price', $this->price, PDO::PARAM_STR);
            $stmt->bindParam(':image_url', $this->image_url, PDO::PARAM_STR);

            // Execute the statement
            if (!$stmt->execute()) {
                // Rollback the transaction
                $this->con->rollBack();
                return false;
            }

            // Get the product id
            $product_id = $this->con->lastInsertId();

            foreach ($this->sizes as $sizeObject) {
                // Insert into 'product_sizes' table
                $query = 'INSERT INTO product_sizes (product_id, size, stock) VALUES (:product_id, :size, :stock)';
                $stmt = $this->con->prepare($query);
                $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
                $stmt->bindParam(':size', $sizeObject['size'], PDO::PARAM_INT);
                $stmt->bindParam(':stock', $sizeObject['stock'], PDO::PARAM_INT);

                // Execute the statement
                if (!$stmt->execute()) {
                    // Rollback the transaction
                    $this->con->rollBack();
                    return false;
                }
            }

            // Commit the transaction
            $this->con->commit();

            return true;
        } catch (Exception) {
            // Rollback the transaction in case of an exception
            $this->con->rollBack();
            return false;
        }
    }

    /**
     * Update a product in the database
     *
     * @return bool
     */
    public function updateProduct(): bool
    {
        try {
            // Start the transaction
            $this->con->beginTransaction();

            // Prepare the query
            $query = 'UPDATE products SET title = :title, brand = :brand, category = :category, type = :type, description = :description, material = :material, color = :color, price = :price' . ($this->image_url !== "" ? ', image_url = :image_url' : '') . ' WHERE id = :id';
            $stmt = $this->con->prepare($query);

            // Bind the parameters
            $stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindParam(':brand', $this->brand, PDO::PARAM_STR);
            $stmt->bindParam(':category', $this->category, PDO::PARAM_STR);
            $stmt->bindParam(':type', $this->type, PDO::PARAM_STR);
            $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
            $stmt->bindParam(':material', $this->material, PDO::PARAM_STR);
            $stmt->bindParam(':color', $this->color, PDO::PARAM_STR);
            $stmt->bindParam(':price', $this->price, PDO::PARAM_STR);
            if ($this->image_url !== "") {
                $stmt->bindParam(':image_url', $this->image_url, PDO::PARAM_STR);
            }
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

            // Execute the statement
            if (!$stmt->execute()) {
                // Rollback the transaction
                $this->con->rollBack();
                return false;
            }

            // Delete old sizes
            $query = 'DELETE FROM product_sizes WHERE product_id = :id';
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

            // Execute the statement
            if (!$stmt->execute()) {
                // Rollback the transaction
                $this->con->rollBack();
                return false;
            }

            // Insert new sizes
            foreach ($this->sizes as $sizeObject) {
                $query = 'INSERT INTO product_sizes (product_id, size, stock) VALUES (:product_id, :size, :stock)';
                $stmt = $this->con->prepare($query);
                $stmt->bindParam(':product_id', $this->id, PDO::PARAM_INT);
                $stmt->bindParam(':size', $sizeObject['size'], PDO::PARAM_INT);
                $stmt->bindParam(':stock', $sizeObject['stock'], PDO::PARAM_INT);

                // Execute the statement
                if (!$stmt->execute()) {
                    // Rollback the transaction
                    $this->con->rollBack();
                    return false;
                }
            }

            // Commit the transaction
            $this->con->commit();

            return true;
        } catch (Exception) {
            // Rollback the transaction in case of an exception
            $this->con->rollBack();
            return false;
        }
    }

    /**
     * Delete a product from the database
     *
     * @return bool
     */
    public function deleteProduct(): bool
    {
        try {
            // Start the transaction
            $this->con->beginTransaction();

            // Delete from 'products' table
            $query = 'DELETE FROM products WHERE id = :id';
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

            // Execute the statement
            if (!$stmt->execute()) {
                // Rollback the transaction
                $this->con->rollBack();
                return false;
            }

            // Commit the transaction
            $this->con->commit();

            return true;
        } catch (Exception) {
            // Rollback the transaction in case of an exception
            $this->con->rollBack();
            return false;
        }
    }
}

