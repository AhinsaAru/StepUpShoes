<?php
// Get the database connection

use App\Classes\DbConnector;
use App\Classes\Product;

require_once("./classes/DbConnector.php");
require_once("./classes/Product.php");

$db = new DbConnector();
$product = new Product();

// Set the database connection for the product
$product->setCon($db->getConnection());

// Get all the products
$shoesData = $product->getCustomProducts(3);

// var_dump($shoesData);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>StepUp Shoes</title>
  <!-- icon -->
  <link rel="icon" href="/assets/favicon.svg" />
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- google font -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
  <!-- google icon -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <style>
    * {
      font-family: "Poppins", sans-serif;
    }

    .carousel {
      display: none;
    }

    .carousel.active {
      display: block;
    }
  </style>
</head>

<body class="bg-gray-100">
  <!-- Header -->
  <?php
  include_once("components/header.php");
  ?>

  <!-- Hero Section with Carousel -->
  <section class="relative bg-slate-900 text-white h-80 xl:h-96 w-full flex">
    <div class="text-center h-full w-full relative">
      <div class="carousel active">
        <img src="/assets/img_1.jpg" alt="" class="h-80 xl:h-96 top-0 absolute w-full object-cover opacity-30 bg-black" />
        <div class="flex flex-col h-80 xl:h-96 justify-center items-center">
          <h1 class="text-4xl font-bold z-10">Welcome to StepUp Shoes</h1>
          <p class="mt-4 z-10">Find the best shoes for every occasion</p>
          <a href="/shoes/" class="mt-6 w-60 z-10 px-6 py-3 bg-slate-950 text-white font-semibold rounded hover:bg-gray-600">
            Browse Collection
          </a>
        </div>
      </div>
      <div class="carousel">
        <img src="/assets/img_2.jpg" alt="" class="h-80 xl:h-96 top-0 absolute w-full object-cover opacity-30 bg-black" />
        <div class="flex flex-col h-80 xl:h-96 justify-center items-center">
          <h1 class="text-4xl font-bold z-10">
            Discover Our Latest Collection
          </h1>
          <p class="mt-4 z-10">Trendy shoes for all seasons</p>
          <a href="/shoes/" class="mt-6 z-10 px-6 py-3 bg-slate-950 text-white font-semibold rounded hover:bg-gray-600">
            Browse Collection
          </a>
        </div>
      </div>
      <div class="carousel">
        <img src="/assets/img_3.jpg" alt="" class="h-80 xl:h-96 top-0 absolute w-full object-cover opacity-30 bg-black" />
        <div class="flex flex-col h-80 xl:h-96 justify-center items-center">
          <h1 class="text-4xl font-bold z-10">Comfort Meets Style</h1>
          <p class="mt-4 z-10">Premium shoes for everyday wear</p>
          <a href="/shoes/" class="mt-6 z-10 px-6 py-3 bg-slate-950 text-white font-semibold rounded hover:bg-gray-600">
            Browse Collection
          </a>
        </div>
      </div>
    </div>
    <button id="prev" class="absolute left-0 top-1/2 rounded-r-full -translate-y-1/2 py-2 bg-gray-700 text-white px-4">
      <span class="material-symbols-outlined flex"> arrow_back_ios </span>
    </button>
    <button id="next" class="absolute right-0 top-1/2 rounded-l-full -translate-y-1/2 bg-gray-700 text-white px-4 py-2">
      <span class="material-symbols-outlined flex"> arrow_forward_ios </span>
    </button>
  </section>

  <!-- men and women section -->
  <section class="py-20">
    <div class="flex flex-col md:flex-row xl:container justify-center mx-auto px-3 sm:px-6 gap-y-5">
      <div class="w-full md:w-1/2 max-w-xl group hover:bg-sky-600 duration-300">
        <img src="/assets/home-banner-mens.png" alt="men" class="w-full group-hover:rounded-md object-cover group-hover:scale-90 duration-300 bg-sky-600 group-hover:border group-hover:border-gray-200/30 group-hover:bg-white/10 group-hover:backdrop-blur-lg group-hover:bg-opacity-20" />
        <div class="flex flex-col mt-3 group-hover:text-white items-center">
          <h2 class="text-2xl sm:text-3xl xl:text-4xl font-semibold tracking-widest">MENS</h2>
          <p class="">Collection</p>
        </div>
      </div>
      <div class="w-full md:w-1/2 flex flex-col-reverse md:flex-col max-w-xl group hover:bg-pink-500 duration-300">
        <div class="flex flex-col mt-3 md:mb-3 group-hover:text-white md:mt-20 items-center">
          <h2 class="text-2xl sm:text-3xl xl:text-4xl font-semibold tracking-widest">WOMENS</h2>
          <p class="">Collection</p>
        </div>
        <img src="/assets/home-banner-womans.png" alt="men" class="w-full group-hover:rounded-md object-cover group-hover:scale-90 duration-300 bg-pink-500 group-hover:border group-hover:border-gray-200/30 group-hover:bg-white/10 group-hover:backdrop-blur-lg group-hover:bg-opacity-20" />
      </div>
    </div>
  </section>

  <!-- categories section -->
  <section class="px-3 md:px-6 flex flex-col items-center">
    <p class="text-center mb-3">Comfortable & Stylish</p>
    <h2 class="text-center text-2xl sm:text-3xl lg:text-4xl font-medium">Discover Our Footwear Collection</h2>
    <div class="grid container gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 mt-8">
      <div class="bg-white rounded-md shadow-md group overflow-hidden drop-shadow-xl p-5 flex flex-col items-center">
        <img src="/assets/collections-boy-shoe.png" alt="boy shoe" class="group-hover:scale-125 duration-300">
        <h3 class="text-lg sm:text-xl lg:text-2xl font-medium">Boys Collection</h3>
        <a href="/shoes/" class="text-sm mt-3 text-blue-600">
          View Collection
        </a>
      </div>
      <div class="bg-white rounded-md shadow-md group overflow-hidden drop-shadow-xl p-5 flex flex-col items-center">
        <img src="/assets/collections-men-shoe.png" alt="men shoe" class="group-hover:scale-125 duration-300">
        <h3 class="text-lg sm:text-xl lg:text-2xl font-medium">Mens Collection</h3>
        <a href="/shoes/" class="text-sm mt-3 text-blue-600">
          View Collection
        </a>
      </div>
      <div class="bg-white rounded-md shadow-md group overflow-hidden drop-shadow-xl p-5 flex flex-col items-center">
        <img src="/assets/collections-woman-shoe.png" alt="womens shoe" class="group-hover:scale-125 duration-300">
        <h3 class="text-lg sm:text-xl lg:text-2xl font-medium">Womens Collection</h3>
        <a href="/shoes/" class="text-sm mt-3 text-blue-600">
          View Collection
        </a>
      </div>
      <div class="bg-white rounded-md shadow-md group overflow-hidden drop-shadow-xl p-5 flex flex-col items-center">
        <img src="/assets/collections-girl-shoe.png" alt="girl shoe" class="group-hover:scale-125 duration-300">
        <h3 class="text-lg sm:text-xl lg:text-2xl font-medium">Girls Collection</h3>
        <a href="/shoes/" class="text-sm mt-3 text-blue-600">
          View Collection
        </a>
      </div>
    </div>
  </section>

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
              <img src="<?php echo $shoe["image_url"]; ?>" alt="<?php echo $shoe["title"]; ?>" class="w-full h-64 object-cover" />
              <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800"><?php echo $shoe["title"]; ?></h3>
                <p class="text-sm mt-3 text-gray-700">
                  <?php echo $shoe["description"]; ?>
                </p>
                <div class="flex items center justify-between">
                  <p class="text-gray-600 mt-2">Rs. <?php echo $shoe["price"]; ?></p>
                  <p class="text-gray-600 mt-2.5 bg-slate-900 text-white font-medium rounded-full px-2 text-xs py-[2px]">
                      <?php echo ucfirst($shoe["brand"]); ?>
                  </p>
                </div>
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
  <?php
  include_once("components/footer.php");
  ?>

  <script>
    // Carousel functionality
    let currentSlide = 0;
    const slides = document.querySelectorAll(".carousel");
    const totalSlides = slides.length;

    document.getElementById("next").addEventListener("click", () => {
      changeSlide((currentSlide + 1) % totalSlides);
    });

    document.getElementById("prev").addEventListener("click", () => {
      changeSlide((currentSlide - 1 + totalSlides) % totalSlides);
    });

    function changeSlide(nextSlide) {
      slides[currentSlide].classList.remove("active");
      currentSlide = nextSlide;
      slides[currentSlide].classList.add("active");
    }

    // Automatic slide change
    setInterval(() => {
      changeSlide((currentSlide + 1) % totalSlides);
    }, 5000); // Change slide every 5 seconds
  </script>
</body>

</html>