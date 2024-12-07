<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage | StepUp Shoes</title>
    <!-- icon -->
    <link rel="icon" href="../assets/favicon.svg" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="../styles/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <!-- google icon -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!--Regular Datatables CSS-->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <!--Responsive Extension Datatables CSS-->
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <!-- sweet alert css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.1/dist/sweetalert2.min.css">
</head>

<body class="bg-gray-100">
    <!-- Header -->
    <?php
    include_once("../components/header.php");
    ?>

    <!-- Hero section -->
    <div class="h-60 w-full flex justify-center items-center text-white bg-gradient-to-r from-sky-700 to-slate-900">
        <h1 class="text-2xl sm:text-4xl md:text-6xl">Manage | StepUp Shoes</h1>
    </div>

    <!-- table -->
    <section class="flex justify-center w-full py-20">
        <div class="xl:container w-full px-2">
            <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white mx-3">
                <div class="flex justify-end mb-3">
                    <button href="add.php" class="bg-slate-900 text-white font-semibold rounded px-4 py-2 mt-4 inline-block" onclick="addShoe()">Add New Shoe</button>
                </div>
                <table id="shoes" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1">Title</th>
                            <th data-priority="2">Brand</th>
                            <th data-priority="3">Category</th>
                            <th data-priority="4">Description</th>
                            <th data-priority="5">Price</th>
                            <th data-priority="6">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php
    include_once("../components/footer.php");
    ?>



    <!-- Popup : add-->
    <div id="popup" class="fixed flex flex-col inset-0 bg-black p-3 h-screen bg-opacity-50 hidden items-center pt-10">
        <div class="bg-white relative p-6 rounded-lg shadow-lg max-w-3xl w-full overflow-scroll">
            <!-- close button -->
            <button class="absolute top-3 right-3 text-black" onclick="closePopup()">
                <span class="material-symbols-outlined"> close </span>
            </button>
            <form class="gap-y-4 md:grid md:grid-cols-2 md:gap-6 mt-5" oninput="updateFormData()" onsubmit="submitForm(event)">
                <!-- Title -->
                <div class="col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" id="title" name="title" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Brand -->
                <div>
                    <label for="brand" class="block text-sm font-medium text-gray-700">Brand</label>
                    <input type="text" id="brand" name="brand" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category" id="category" class="mt-1 block p-2.5 border border-gray-300 rounded-md shadow-sm w-full">
                        <option value="Best Sellers">Best Sellers</option>
                        <option value="Featured Products">Featured Products</option>
                        <option value="Top Rated">Top Rated</option>
                        <option value="New Arrivals">New Arrivals</option>
                        <option value="On Sale">On Sale</option>
                    </select>
                </div>

                <!-- Description -->
                <div class="col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="4" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm"></textarea>
                </div>

                <!-- Material -->
                <div>
                    <label for="material" class="block text-sm font-medium text-gray-700">Material</label>
                    <input type="text" id="material" name="material" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Color -->
                <div>
                    <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
                    <input type="text" id="color" name="color" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Size and Stock -->
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Size and Stock</label>
                    <div id="sizes" class="mt-2 space-y-1 w-full">
                        <!-- Size and Stock Fields will be added here -->
                    </div>
                    <button type="button" onclick="addSizeField()" class="mt-2 px-2 py-1 bg-green-500 text-white rounded-sm shadow-sm">+ Add Size</button>
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" id="price" name="price" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Type</label>
                    <select name="type" id="type" class="mt-1 block p-2.5 border border-gray-300 rounded-md shadow-sm w-full">
                        <option value="men">Men</option>
                        <option value="women">Women</option>
                        <option value="girl">Girl</option>
                        <option value="boy">Boy</option>
                        <option value="unisex">Unisex</option>
                    </select>
                </div>

                <!-- Image -->
                <div class="col-span-2">
                    <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                    <label class="w-full h-32 flex flex-col justify-center items-center border border-dashed border-gray-600 rounded-md mt-4">
                        <input type="file" accept="image/*" id="image" name="image" class="mt-1 peer sr-only block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                        <span class="material-symbols-outlined text-5xl">
                            cloud_upload
                        </span>
                        <p class="text-gray-500" id="file-name">Upload shoes image</p>
                        <!-- show file name -->
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="col-span-2 mt-3">
                    <button type="submit" class="w-full p-2 bg-indigo-600 text-white rounded-md shadow-sm">Submit</button>
                </div>
            </form>
        </div>
    </div>






    <!-- Popup : update -->
    <div id="editPopup" class="fixed flex flex-col inset-0 bg-black p-3 h-screen bg-opacity-50 items-center pt-10" style="display:none;">
        <div class="bg-white relative p-6 rounded-lg shadow-lg max-w-3xl w-full overflow-scroll">
            <!-- close button -->
            <button class="absolute top-3 right-3 text-black" onclick="closeEditPopup()">
                <span class="material-symbols-outlined"> close </span>
            </button>
            <form class="gap-y-4 md:grid md:grid-cols-2 md:gap-6 mt-5" oninput="updateEditFormData()" onsubmit="submitEditDetails(event)">
                <!-- Title -->
                <div class="col-span-2">
                    <label for="editTitle" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" id="editTitle" name="title" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Brand -->
                <div>
                    <label for="editBrand" class="block text-sm font-medium text-gray-700">Brand</label>
                    <input type="text" id="editBrand" name="brand" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Category -->
                <div>
                    <label for="editCategory" class="block text-sm font-medium text-gray-700">Category</label>
                    <input type="text" id="editCategory" name="category" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Description -->
                <div class="col-span-2">
                    <label for="editDescription" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="editDescription" name="description" rows="4" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm"></textarea>
                </div>

                <!-- Material -->
                <div>
                    <label for="editMaterial" class="block text-sm font-medium text-gray-700">Material</label>
                    <input type="text" id="editMaterial" name="material" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Color -->
                <div>
                    <label for="editColor" class="block text-sm font-medium text-gray-700">Color</label>
                    <input type="text" id="editColor" name="color" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                </div>

                <!-- Size and Stock -->
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Size and Stock</label>
                    <div id="editSizes" class="mt-2 space-y-1 w-full">
                        <!-- Size and Stock Fields will be added here -->
                    </div>
                    <button type="button" onclick="addSizeField('editSizes' , 'size-stock-field' , true)" class="mt-2 px-2 py-1 bg-green-500 text-white rounded-sm shadow-sm">+ Add Size</button>
                </div>

                <!-- Price -->
                <div>
                    <label for="editPrice" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" id="editPrice" name="price" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                </div>
                <!-- Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Type</label>
                    <select name="type" id="editType" class="mt-1 block p-2.5 border border-gray-300 rounded-md shadow-sm w-full">
                        <option value="men">Men</option>
                        <option value="women">Women</option>
                        <option value="girl">Girl</option>
                        <option value="boy">Boy</option>
                        <option value="unisex">Unisex</option>
                    </select>
                </div>

                <!-- Image -->
                <div class="col-span-2">
                    <label for="editImage" class="block text-sm font-medium text-gray-700">Image</label>
                    <label class="w-full h-32 flex flex-col justify-center items-center border border-dashed border-gray-600 rounded-md mt-4">
                        <input type="file" accept="image/*" id="editImage" name="image" class="mt-1 peer sr-only block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                        <span class="material-symbols-outlined text-5xl">
                            cloud_upload
                        </span>
                        <p class="text-gray-500" id="edit-file-name">Upload shoes image</p>
                        <!-- show file name -->
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="col-span-2 mt-3">
                    <button type="submit" class="w-full p-2 bg-indigo-600 text-white rounded-md shadow-sm">Submit</button>
                </div>
            </form>
        </div>
    </div>





    <!-- Form Handling -->
    <script>
        // Initialize formDataObject with default values
        let formDataObject = {
            title: '',
            brand: '',
            category: '',
            description: '',
            material: '',
            color: '',
            sizes: [],
            price: '',
            type: '',
            image: ''
        };

        // Function to update formDataObject with form values
        function updateFormData() {
            // Update basic fields
            formDataObject.title = document.getElementById('title').value;
            formDataObject.brand = document.getElementById('brand').value;
            formDataObject.category = document.getElementById('category').value;
            formDataObject.description = document.getElementById('description').value;
            formDataObject.material = document.getElementById('material').value;
            formDataObject.color = document.getElementById('color').value;
            formDataObject.price = document.getElementById('price').value;
            formDataObject.type = document.querySelector('select[name="type"]')?.value || 'men';
            formDataObject.image = document.getElementById('image').files[0];

            // Update sizes array
            formDataObject.sizes = [];
            document.querySelectorAll('.size-field').forEach(sizeField => {
                const size = sizeField.querySelector('select[name="size[]"]').value;
                const stock = sizeField.querySelector('input[name="stock[]"]').value;
                if (size && stock) {
                    formDataObject.sizes.push({
                        size,
                        stock
                    });
                }
            });



            // Update the file name
            const fileName = document.getElementById('image').files[0]?.name || 'Upload shoes image';
            document.getElementById('file-name').innerText = fileName;

        }

        function addSizeField(id, classes, isUpdate = false) {
            const sizesDiv = document.getElementById(id || 'sizes');
            const sizeField = document.createElement('div');
            sizeField.classList.add(classes || 'size-field', 'w-full', 'flex', 'items-center', 'gap-1');

            let optionsHtml = `<option value="">Select Size</option>`;
            const sizes = Array.from({
                length: 11
            }, (_, i) => i + 35);
            sizes.forEach(s => {
                optionsHtml += `<option value="${s}">${s}</option>`;
            });


            sizeField.innerHTML = `
        <select name="size[]" class="mt-1 block p-2.5 border border-gray-300 rounded-md shadow-sm w-full" onchange="updateFormData()">
        ${optionsHtml}
        </select>
        <input type="number" name="stock[]" placeholder="Stock" class="mt-1 w-full block p-2 border border-gray-300 rounded-md shadow-sm flex-wrap" oninput="updateFormData()">
        <button type="button" class="p-2 bg-red-500 text-white rounded-md shadow-sm" onclick="removeSizeField(this , ${isUpdate})">Remove</button>
      `;

            sizesDiv.appendChild(sizeField);
        }

        function removeSizeField(button, isUpdate = false) {
            button.parentElement.remove();
            if (isUpdate) {
                updateEditFormData();
            } else {
                updateFormData();
            }
        }



        async function submitForm(e) {
            e.preventDefault();
            updateFormData();

            const errorMsg = validateFormData(formDataObject);
            if (errorMsg) {
                alert(errorMsg);
                return;
            }

            let formData = new FormData();

            // Append each property from the object to the FormData
            Object.keys(formDataObject).forEach(key => {
                if (key === 'sizes') {
                    formDataObject.sizes.forEach(size => formData.append('sizes[]', JSON.stringify(size)));
                } else {
                    formData.append(key, formDataObject[key]);
                }
            });

            await fetch('/api/add.php', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    alert('Shoe added successfully');
                    // Clear the form
                    document.getElementById('title').value = '';
                    document.getElementById('brand').value = '';
                    document.getElementById('category').value = '';
                    document.getElementById('description').value = '';
                    document.getElementById('material').value = '';
                    document.getElementById('color').value = '';
                    document.getElementById('price').value = '';
                    document.querySelector('select[name="type"]').value = 'men';
                    document.getElementById('image').value = '';

                    formDataObject = {
                        title: '',
                        brand: '',
                        category: '',
                        description: '',
                        material: '',
                        color: '',
                        sizes: [],
                        price: '',
                        type: '',
                        image: ''
                    };
                    closePopup();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to add shoe');
                });
        }


        function validateFormData(formData) {
            if (!formData.title) return 'Title is required.';
            if (!formData.brand) return 'Brand is required.';
            if (!formData.category) return 'Category is required.';
            if (!formData.description) return 'Description is required.';
            if (!formData.material) return 'Material is required.';
            if (!formData.color) return 'Color is required.';
            if (!formData.price) return 'Price is required.';
            if (formData.sizes.length === 0) return 'At least one size and stock is required.';
            if (!formData.image) return 'Image is required.';
            return '';
        }
    </script>



    <!--Popup functionality -->

    <script>
        //Function to show the popup
        function addShoe() {
            document.getElementById("popup").classList.remove("hidden");
            document.getElementById("popup").classList.add("flex");
        }

        // Function to hide the popup
        function closePopup() {
            document.getElementById("popup").classList.remove("flex");
            document.getElementById("popup").classList.add("hidden");
        }

        // Function to add a new product
        function addProduct() {
            const category = document.getElementById('category').value;
            const title = document.getElementById('productTitle').value.trim();
            const price = parseFloat(document.getElementById('productPrice').value.trim());

            if (title && !isNaN(price)) {
                // Create a product object
                const product = {
                    title,
                    price
                };

                // Add the product to the selected category
                let products = JSON.parse(localStorage.getItem('products')) || {};
                if (!products[category]) {
                    products[category] = [];
                }
                products[category].push(product);
                localStorage.setItem('products', JSON.stringify(products));

                // Update the products list display
                updateProductsList();
                closePopup();
            } else {
                alert('Please enter valid product title and price.');
            }
        }

        // Function to update the product list display
        function updateProductsList() {
            const productsList = document.getElementById('productsList');
            productsList.innerHTML = '';

            let products = JSON.parse(localStorage.getItem('products')) || {};
            for (const [category, items] of Object.entries(products)) {
                const categoryDiv = document.createElement('div');
                categoryDiv.classList.add('category-section');

                const categoryTitle = document.createElement('h3');
                categoryTitle.textContent = category;
                categoryTitle.classList.add('text-lg', 'font-bold', 'mt-4');
                categoryDiv.appendChild(categoryTitle);

                const productList = document.createElement('ul');
                items.forEach(item => {
                    const listItem = document.createElement('li');
                    listItem.textContent = `${item.title} - $${item.price.toFixed(2)}`;
                    productList.appendChild(listItem);
                });

                categoryDiv.appendChild(productList);
                productsList.appendChild(categoryDiv);
            }
        }



        // Event listeners
        document.getElementById('openPopupButton').addEventListener('click', addShoe);
        document.getElementById('closePopupButton').addEventListener('click', closePopup);
        document.getElementById('addProductButton').addEventListener('click', addProduct);



        // Initial load of products
        updateProductsList();
    </script>


    <!-- jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <!--Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.1/dist/sweetalert2.all.min.js"></script>





    <!-- script for actions -->
    <script>
        $(document).ready(function() {
            const buttons = `<button id="delete" class="bg-red-500 p-1 m-1 text-white rounded-full"> <span class="material-symbols-outlined flex">delete</span></button> 
            <button id="edit" class="bg-emerald-500 p-1 m-1 text-white rounded-full"> <span class="material-symbols-outlined flex">edit</span></button>`
            var table = $('#shoes').DataTable({
                    responsive: true,
                    ajax: {
                        url: '/api/get_all_products.php',
                        dataSrc: ''
                    },
                    columns: [{
                            data: 'title'
                        },
                        {
                            data: 'brand'
                        },
                        {
                            data: 'category'
                        },
                        {
                            data: 'description'
                        },
                        {
                            data: 'price'
                        },
                    ],
                    columnDefs: [{
                        data: null,
                        defaultContent: buttons,
                        targets: 5
                    }]

                })
                .columns.adjust()
                .responsive.recalc();

            table.on('click', '#edit', function(e) {
                let data = table.row(e.target.closest('tr')).data();
                // save data in formDataObject to use in submitEditDetails
                formDataObject = data;


                $('#editTitle').val(data.title);
                $('#editBrand').val(data.brand);
                $('#editCategory').val(data.category);
                $('#editDescription').val(data.description);
                $('#editMaterial').val(data.material);
                $('#editColor').val(data.color);
                $('#editPrice').val(data.price);
                $('#editType').val(data.type);

                // Clear existing dynamic fields
                $('#editSizes').empty();

                // Populate dynamic fields
                data.sizes.forEach(function(size) {
                    addEditSizeField(size.size, size.stock);
                });

                // Show the popup
                $('#editPopup').show();

            });
            table.on('click', '#delete', function(e) {
                let data = table.row(e.target.closest('tr')).data();
                const swalWithButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "bg-red-500 py-1.5 w-32 text-white rounded-md mx-3",
                        cancelButton: "bg-emerald-500 py-1.5 w-32 text-white rounded-md mx-3"
                    },
                    buttonsStyling: false
                });
                swalWithButtons.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // delete the row
                        table.row(e.target.closest('tr')).remove().draw();
                        // delete the row from the database
                        $.ajax({
                            url: '/api/delete.php',
                            type: 'POST',
                            data: {
                                id: data?.id
                            },
                            success: function(response) {
                                swalWithButtons.fire({
                                    title: "Deleted!",
                                    text: "Your file has been deleted.",
                                    icon: "success"
                                });
                            },
                            error: function(error) {
                                swalWithButtons.fire({
                                    title: "Error!",
                                    text: "Failed to delete the file.",
                                    icon: "error"
                                });
                            }
                        });


                    } else if (
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithButtons.fire({
                            title: "Cancelled",
                            text: "Your imaginary file is safe :)",
                            icon: "error"
                        });
                    }
                });
            });

            function addEditSizeField(size = '', stock = '') {
                const sizeField = document.createElement('div');
                sizeField.classList.add('w-full', 'flex', 'items-center', 'gap-1', 'size-stock-field');

                let optionsHtml = `<option value="">Select Size</option>`;
                const sizes = Array.from({
                    length: 11
                }, (_, i) => i + 35);
                sizes.forEach(s => {
                    optionsHtml += `<option value="${s}" ${s == size ? 'selected' : ''}>${s}</option>`;
                });

                sizeField.innerHTML = `
                    <select name="size[]" class="mt-1 block p-2.5 border border-gray-300 rounded-md shadow-sm w-full" onchange="updateFormData()">
                        ${optionsHtml}
                    </select>
                    <input value="${stock}" type="number" name="stock[]" placeholder="Stock" class="mt-1 w-full block p-2 border border-gray-300 rounded-md shadow-sm flex-wrap" oninput="updateFormData()">
                    <button type="button" class="p-2 bg-red-500 text-white rounded-md shadow-sm" onclick="removeSizeField(this , true)">Remove</button>
                `;
                $('#editSizes').append(sizeField);
            }

            function removeThisField(button) {
                $(button).closest('.size-stock-field').remove();
            }

        });

        function closeEditPopup() {
            $('#editPopup').hide();
        }

        async function submitEditDetails(event) {
            event.preventDefault();
            updateEditFormData();

            const errorMsg = validateFormData(formDataObject);
            if (errorMsg) {
                alert(errorMsg);
                return;
            }

            let formData = new FormData();
            Object.keys(formDataObject).forEach(key => {
                if (key === 'sizes') {
                    formDataObject.sizes.forEach(size => formData.append('sizes[]', JSON.stringify(size)));
                } else {
                    formData.append(key, formDataObject[key]);
                }
            });

            await fetch('/api/update.php', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    alert('Shoe updated successfully');
                    formDataObject = {
                        title: '',
                        brand: '',
                        category: '',
                        description: '',
                        material: '',
                        color: '',
                        sizes: [],
                        price: '',
                        type: '',
                        image: ''
                    };
                    closeEditPopup();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to update shoe');
                });
        }


        function updateEditFormData() {
            formDataObject.title = document.getElementById('editTitle').value;
            formDataObject.brand = document.getElementById('editBrand').value;
            formDataObject.category = document.getElementById('editCategory').value;
            formDataObject.description = document.getElementById('editDescription').value;
            formDataObject.material = document.getElementById('editMaterial').value;
            formDataObject.color = document.getElementById('editColor').value;
            formDataObject.price = document.getElementById('editPrice').value;
            formDataObject.type = document.getElementById('editType').value;
            formDataObject.image = document.getElementById('editImage').files[0] || '';

            formDataObject.sizes = [];
            document.querySelectorAll('.size-stock-field').forEach(sizeField => {
                const size = sizeField.querySelector('select[name="size[]"]').value;
                const stock = sizeField.querySelector('input[name="stock[]"]').value;
                if (size && stock) {
                    formDataObject.sizes.push({
                        size,
                        stock
                    });
                }
                console.log(formDataObject.sizes)
            });

            // Update the file name
            const fileName = document.getElementById('editImage').files[0]?.name || 'Upload shoes image';
            document.getElementById('edit-file-name').innerText = fileName;

            console.log(formDataObject.sizes)
        }


        document.addEventListener('DOMContentLoaded', () => {
            const priceInput = document.getElementById('editPrice');

            // Prevent negative values in price input
            priceInput.addEventListener('input', () => {
                if (parseFloat(priceInput.value) < 0) {
                    priceInput.value = 0;
                }
            });
        });
    </script>

</body>

</html>