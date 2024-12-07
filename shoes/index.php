<?php
// Get the database connection

use App\Classes\DbConnector;
use App\Classes\Product;

require_once("../classes/DbConnector.php");
require_once("../classes/Product.php");

$db = new DbConnector();
$product = new Product();

// Set the database connection for the product
$product->setCon($db->getConnection());

// Get all the products
$shoesData = $product->getCustomProducts();

// var_dump($shoesData);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shoes | StepUp Shoes</title>
    <!-- icon -->
    <link rel="icon" href="../assets/favicon.svg" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <!-- google icon -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>

<body class="bg-gray-100">
    <!-- Header -->
    <?php include_once("../components/header.php"); ?>

    <!-- Hero section -->
    <div class="h-60 w-full flex justify-center items-center text-white bg-gradient-to-r from-sky-700 to-slate-900">
        <h1 class="text-2xl sm:text-4xl md:text-6xl">Shoes | StepUp Shoes</h1>
    </div>

    <!-- Featured Products Section -->
    <?php
    // Function to display the shoes
    function displayShoes($category, $shoes): void
    {
    ?>
        <section class="py-20">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-gray-800 text-center">
                    <?php echo ucwords(str_replace("_", " ", $category)); ?>
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mt-8">
                    <?php
                    foreach ($shoes as $shoe) {
                    ?>
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                            <img src="/<?php echo $shoe["image_url"]; ?>" alt="<?php echo $shoe['title']; ?>" class="w-full h-64 object-cover" />
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-800"><?php echo $shoe["title"]; ?></h3>
                                <p class="text-sm mt-3 text-gray-700">
                                    <?php echo $shoe["description"]; ?>
                                </p>
                                <div class="flex items-center justify-between">
                                    <p class="text-gray-600 mt-2">Rs. <?php echo $shoe["price"]; ?></p>
                                    <p class="text-gray-600 mt-2.5 bg-slate-900 text-white font-medium rounded-full px-2 text-xs py-[2px]" style="background-color: black;color:aliceblue;">
                                        <?php echo $shoe["brand"]; ?>
                                    </p>
                                </div>
                                <p class="text-sm text-gray-600 mt-2">Type: <?php echo ucfirst($shoe["type"]); ?></p>
                                <button class="mt-4 w-full px-4 py-1.5 bg-cyan-800 text-white font-semibold rounded-lg hover:bg-cyan-600" onclick="openPopup('<?php echo $shoe["title"]; ?>', '<?php echo $shoe["price"]; ?>', '<?php echo $shoe["description"]; ?>', '<?php echo htmlspecialchars(json_encode($shoe["sizes"]), ENT_QUOTES); ?>')">
                                    More Details
                                </button>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="flex justify-center mt-3">
                    <a href="/shoes" class="text-blue-700 font-medium">View More</a>
                </div>
            </div>
        </section>
    <?php
    }
    ?>

    <?php
    // Display the shoes for each category
    foreach ($shoesData as $category => $shoes) {
        displayShoes($category, $shoes);
    }
    ?>

    <!-- Footer -->
    <?php include_once("../components/footer.php"); ?>

    <!-- Popup -->
    <div id="popup" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
            <h3 id="popup-product-name" class="text-xl font-semibold text-gray-800"></h3>
            <p class="mt-2 text-sm font-medium">Price: <span id="popup-product-price" class="text-gray-600"></span></p>
            <p class="text-sm font-medium mt-2">Description: <span id="popup-product-description" class="text-gray-600"></span></p>
            <div class="text-sm font-medium mt-2">Availability:
                <div id="popup-product-availability" class="text-gray-600"></div>
            </div>
            <div class="flex justify-end">
                <button onclick="closePopup()" class="mt-4 px-4 py-1.5 border border-gray-800 hover:text-white text-slate-900 font-semibold rounded-lg hover:bg-gray-600">
                    Close
                </button>
            </div>
        </div>
    </div>

    <script>
        // Popup functionality
        function openPopup(name, price, description, available) {
            document.getElementById("popup-product-name").innerText = name;
            document.getElementById("popup-product-price").innerText = "Rs. " + price;
            document.getElementById("popup-product-description").innerText = description;
            const availability = document.getElementById("popup-product-availability");
            // Clear previous content
            availability.innerHTML = '';
            // add sizes and stock to the popup availability div
            available = JSON.parse(available);
            available.forEach(element => {
                const stock = element.stock;
                const size = element.size;
                const p = document.createElement("p");
                p.classList.add('mt-1', 'ms-2');
                p.innerText = size + " : " + stock + " Units Available";
                availability.appendChild(p);
            });

            document.getElementById("popup").classList.remove("hidden");
            document.getElementById("popup").classList.add("flex");
        }

        function closePopup() {
            document.getElementById("popup").classList.remove("flex");
            document.getElementById("popup").classList.add("hidden");
        }
    </script>

</body>

</html>
