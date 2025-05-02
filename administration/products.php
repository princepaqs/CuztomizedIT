<?php
session_start();
$current_page = basename($_SERVER['PHP_SELF']);

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

require_once '../dbconfig/dbconfig.php';
require_once 'get_products.php'; 

$products = getProducts();
$totalProducts  = getProducts();
$categories = getUniqueCategories($products);
$totalPublished = countPublishedProducts();

$selected_category = isset($_GET['category']) ? $_GET['category'] : 'All';
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : 'All';
$search_query = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';

// Filter by category
if ($selected_category !== 'All') {
    $products = array_filter($products, function ($product) use ($selected_category) {
        return $product['Category'] === $selected_category;
    });
}

// Filter by search
if (!empty($search_query)) {
    $products = array_filter($products, function ($product) use ($search_query) {
        return stripos($product['Name'], $search_query) !== false;
    });
}

// Reindex array after filtering
$products = array_values($products);

// Pagination Setup
$total_products = count($products);
$limit = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $limit;
$total_pages = ceil($total_products / $limit);

// If searching and results ≤ 10, show all without pagination
if (!empty($search_query) && $total_products <= 10) {
    $paged_products = $products;
    $total_pages = 1; // Avoid showing pagination
} else {
    $paged_products = array_slice($products, $start, $limit);
}

// Optional: console log
echo "<script>console.log(" . json_encode($paged_products) . ");</script>";
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    
    <div class="flex min-h-screen w-full">
        <!-- Sidebar -->
    <div class="w-64 h-screen bg-[#272c2b] text-white flex flex-col justify-between p-5">
        <div>
            <h1 class="text-3xl font-bold mb-8 mt-5 text-orange-500">Admin Panel</h1>
            <ul>
                <li class="mb-4"><a href="dashboard.php" class="hover:bg-orange-500 px-3 py-2 rounded block flex flex-row gap-2 items-center <?= $current_page == 'dashboard.php' ? 'bg-orange-500' : 'hover:bg-orange-500' ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                    </svg>
                        
                    Dashboard</a></li>
                <li class="mb-4"><a href="products.php" class="hover:bg-orange-500 px-3 py-2 rounded block flex flex-row gap-2 items-center <?= $current_page == 'products.php' ? 'bg-orange-500' : 'hover:bg-orange-500' ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>

                    Products</a></li>
                <li class="mb-4"><a href="services.php" class="hover:bg-orange-500 px-3 py-2 rounded block flex flex-row gap-2 items-center <?= $current_page == 'services.php' ? 'bg-orange-500' : 'hover:bg-orange-500' ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>

                    Services</a></li>
                <li class="mb-4"><a href="aboutus.php" class="hover:bg-orange-500 px-3 py-2 rounded block flex flex-row gap-2 items-center <?= $current_page == 'aboutus.php' ? 'bg-orange-500' : 'hover:bg-orange-500' ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>

                    About Us</a></li>
                <li class="mb-4"><a href="faq.php" class="hover:bg-orange-500 px-3 py-2 rounded block flex flex-row gap-2 items-center <?= $current_page == 'faq.php' ? 'bg-orange-500' : 'hover:bg-orange-500' ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>
                    FAQ</a></li>
                <li class="mb-4"><a href="settings.php" class="hover:bg-orange-500 px-3 py-2 rounded block flex flex-row gap-2 items-center <?= $current_page == 'settings.php' ? 'bg-orange-500' : 'hover:bg-orange-500' ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>

                    Settings</a></li>
            </ul>
        </div>

        <!-- Logout Button -->
        <div>
            <button id="logoutBtn" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded block text-center text-sm font-semibold w-full flex flex-row items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1 0 12.728 0M12 3v9" />
                </svg>

                <a class="pl-10">Logout</a></button>
        </div>
    </div>

        <!-- Main Content -->
        <div class="flex-1 p-10 relative w-full">
            <div class="absolute right-10 top-10 text-sm text-gray-600 font-medium">
                <span id="datetime"></span>
            </div>

            <h2 class="text-3xl text-gray-800 mb-6 font-bold">Products</h2>

            <!-- Overview -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
                <div class="bg-white p-4 rounded shadow text-center">
                    <h2 class="text-xl font-semibold">Total Products</h2>
                    <p class="text-2xl text-[#f59002] font-bold"><?php echo count($totalProducts); ?></p>
                </div>
                <div class="bg-white p-4 rounded shadow text-center">
                    <h2 class="text-xl font-semibold">Categories</h2>
                    <p class="text-2xl text-[#f59002] font-bold"><?php echo count($categories); ?></p>
                </div>
                <div class="bg-white p-4 rounded shadow text-center">
                    <h2 class="text-xl font-semibold">Published Product</h2>
                    <p class="text-2xl text-[#f59002] font-bold"><?php echo $totalPublished; ?></p>
                </div>
            </div>

            <div class="flex items-center justify-between  gap-5">
  
                <!-- Category Filter Buttons -->
                <div id="filter-buttons" class="flex flex-wrap gap-2 text-sm">
                    <button class="filter-btn py-2 rounded border w-[100px] <?= $selectedCategory === 'All' ? 'bg-orange-500 text-white' : 'bg-white hover:bg-orange-100' ?>" data-category="All" onclick="filterByCategory('All')">All</button>
                    <?php foreach ($categories as $cat): ?>
                        <button class="filter-btn py-2 rounded border w-[100px] <?= $selectedCategory === $cat ? 'bg-orange-500 text-white' : 'bg-white hover:bg-orange-100' ?>" 
                                data-category="<?= htmlspecialchars($cat) ?>" 
                                onclick="filterByCategory('<?= htmlspecialchars($cat) ?>')">
                            <?= htmlspecialchars($cat) ?>
                        </button>
                    <?php endforeach; ?>
                </div>

                    
                <div class="flex flex-row gap-4 mt-5">
                    <button onclick="openModal()" class="h-10 w-10 flex items-center justify-center bg-orange-500 text-white rounded-full hover:bg-orange-600">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 font-bold">
                            <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <form method="GET" class="flex flex-row gap-1">
                        <input type="text" name="search" id="searchInput" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                            placeholder="Search product..." 
                            class="h-10 w-64 py-2 px-2 outline-none text-sm border border-gray-300 rounded" />
                        <button type="submit" class="h-10 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Search
                        </button>
                    </form>

                    
                </div>
        </div>

            <!-- Product Table -->
            <div id="productList" class="bg-white rounded shadow overflow-x-auto mt-2">
                <table class="table-auto min-w-full text-left" id="productTable">
                    <thead class="bg-[#272c2b] text-white">
                        <tr>
                            <th class="px-4 py-1">ID</th>
                            <th class="px-4 py-1">Picture</th>
                            <th class="px-4 py-1">Name</th>
                            <th class="px-4 py-1">Category</th>
                            <th class="px-4 py-1">Description</th>
                            <th class="px-4 py-1">Published</th>
                            <th class="px-4 py-1">Date</th>
                            <th class="px-4 py-1">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="product-table">
                    <?php foreach ($paged_products  as $product): ?>
                        <tr class="border-t" data-category="<?= htmlspecialchars($product['Category']) ?>">
                            <td class="px-4 py-1"><?= $product['id'] ?></td>
                            <td class="px-4 py-1">
                                <?php if (!empty($product['Picture'])): ?>
                                    <img src="../assets/<?= htmlspecialchars($product['Picture']) ?>" alt="Product Image" class="w-10 h-10 object-cover rounded cursor-pointer product-image">
                                <?php else: ?>
                                    <span class="text-gray-500 italic">No image</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-1"><?= htmlspecialchars($product['Name']) ?></td>
                            <td class="px-4 py-1"><?= htmlspecialchars($product['Category']) ?></td>
                            <td class="px-4 py-1"><?= htmlspecialchars($product['Description']) ?></td>
                            <td class="px-4 py-1">
                                <a class="px-6 py-0.5 rounded-2xl <?= $product['Published'] ? 'bg-green-200 text-green-600' : 'bg-red-200 text-red-600' ?>"><?= $product['Published'] ? 'Yes' : 'No' ?></a>
                            </td>
                            <td class="px-4 py-1"><?= $product['CreatedDate'] ?></td>
                            <td class="flex flex-row items-center justify-center mt-2 px-4 py-1 gap-2">
                                <a href="javascript:void(0)" onclick="openEditModal(
                                    '<?= $product['id'] ?>',
                                    '<?= htmlspecialchars($product['Name']) ?>',
                                    '<?= htmlspecialchars($product['Category']) ?>',
                                    '<?= htmlspecialchars($product['Description']) ?>',
                                    '<?= $product['Published'] ? "1" : "0" ?>'
                                    )">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-blue-400 size-6">
                                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                    <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                    </svg>

                                </a>

                                <a href="javascript:void(0)" class="text-red-400 " onclick="confirmDelete(<?= $product['id'] ?>)">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                                </svg>

                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <?php if ($total_pages > 1): ?>
            <!-- Pagination -->
            <div class="flex justify-center mt-2 space-x-2 text-xs">
                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?>&category=<?= urlencode($selectedCategory) ?>" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-black rounded">Previous</a>
                <?php endif; ?>

                <?php
                    $start = max(1, $page - 1);
                    $end = min($total_pages, $page + 1);
                    if ($page == 1) $end = min($total_pages, 3);
                    elseif ($page == $total_pages) $start = max(1, $total_pages - 2);
                ?>

                <?php for ($i = $start; $i <= $end; $i++): ?>
                    <a href="?page=<?= $i ?>&category=<?= urlencode($selected_category) ?>" class="px-4 py-2 <?= $page == $i ? 'bg-orange-500 text-white' : 'bg-gray-200 hover:bg-gray-300 text-black' ?> rounded"><?= $i ?></a>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?= $page + 1 ?>&category=<?= urlencode($selected_category) ?>" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-black rounded">Next</a>
                <?php endif; ?>
            </div>
            <?php endif; ?>





            <!-- Image Modal -->
            <div id="imageModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
                <button id="closeModal" class="absolute top-5 right-5 text-white text-5xl font-bold">&times;</button>
                <div class="rounded relative max-w-3xl">
                    <img id="modalImage" src="" alt="Enlarged Product Image" class="max-h-[80vh] max-w-full object-contain">
                </div>
            </div>


        </div>
    </div>

    <!-- Modal -->
    <div id="addModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-xl font-semibold mb-4">Add New Product</h2>
            <form method="POST" action="add_product.php" enctype="multipart/form-data">
                <div class="mb-4">
                    <label class="block text-sm mb-1">Product Name</label>
                    <input type="text" name="name" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm mb-1">Category</label>
                    <input type="text" name="category" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm mb-1">Description</label>
                    <textarea name="description" class="w-full px-3 py-2 border rounded" rows="3"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm mb-1">Picture</label>
                    <input type="file" name="picture" class="w-full px-3 py-2 border rounded">
                </div>
                <!-- Hidden input for Type -->
                <input type="hidden" name="type" value="Default">
                <!-- Published checkbox (optional, default is checked) -->
                <div class="mb-4 flex items-center">
                    <input type="checkbox" name="published" value="1" checked class="mr-2">
                    <label class="text-sm">Published</label>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600">Add</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-xl font-semibold mb-4">Edit Product</h2>
            <form id="editForm" method="POST" action="edit_product.php" enctype="multipart/form-data">
                <input type="hidden" id="editProductId" name="id">
                <div class="mb-4">
                    <label class="block text-sm mb-1">Product Name</label>
                    <input type="text" id="editName" name="name" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm mb-1">Category</label>
                    <input type="text" id="editCategory" name="category" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm mb-1">Description</label>
                    <textarea id="editDescription" name="description" class="w-full px-3 py-2 border rounded" rows="3"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm mb-1">Picture</label>
                    <input type="file" name="picture" class="w-full px-3 py-2 border rounded" id="picture">
                </div>
                <div class="mb-4 flex items-center">
                    <input type="checkbox" id="editPublished" name="published" value="1" class="mr-2">
                    <label class="text-sm">Published</label>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600">Save Changes</button>
                </div>
            </form>
        </div>
    </div>


    <script src="script.js" ></script>

    <!-- filter button -->
    <script>


        // Filter Script
        const buttons = document.querySelectorAll('.filter-btn');
        const rowss = document.querySelectorAll('#product-table tr');

        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                // Highlight active button
                buttons.forEach(b => b.classList.remove('bg-orange-400', 'text-white'));
                btn.classList.add('bg-orange-400', 'text-white');

                const category = btn.getAttribute('data-category');

                rowss.forEach(row => {
                    const rowCategory = row.getAttribute('data-category');
                    if (category === 'All' || rowCategory === category) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>

<script>
    function filterByCategory(category) {
        const url = new URL(window.location.href);
        url.searchParams.set('category', category);
        url.searchParams.set('page', 1); // reset to first page
        window.location.href = url.toString();
    }
</script>



    <script>
    function confirmDelete(productId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('delete_product.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        product_id: productId
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            title: 'Deleted!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Refresh the page after alert is closed
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error!', data.message, 'error');
                    }
                })
                .catch(error => {
                    Swal.fire('Error!', 'Network error occurred.', 'error');
                    console.error('Fetch error:', error);
                });
            } else {
                Swal.fire('Cancelled', 'Your product is safe 🙂', 'info');
            }
        });
    }
    
        function openEditModal(id, name, category, description, published) {
        // Populate modal with the product data
        console.log(id, name, category, description, published);
        document.getElementById('editProductId').value = id;
        document.getElementById('editName').value = name;
        document.getElementById('editCategory').value = category;
        document.getElementById('editDescription').value = description;
        document.getElementById('editPublished').checked = published === "1"; 
        
        // Open the modal
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    // Adding event listener to handle the form submission via AJAX or normal post
    document.getElementById('editForm').addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch('edit_product.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success alert
                Swal.fire({
                    icon: 'success',
                    title: 'Product Updated',
                    text: 'The product has been successfully updated.',
                }).then(() => {
                    // Close the modal
                    closeEditModal();
                    // Refresh the page
                    location.reload();
                });
            } else {
                // Show error alert
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong while updating the product.',
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while processing your request.',
            });
        });
    });

    </script>


  

    <script>
        function openModal() {
            document.getElementById('addModal').classList.remove('hidden');
        }
        function closeModal() {
            document.getElementById('addModal').classList.add('hidden');
        }
        

        document.addEventListener("DOMContentLoaded", function () {
            // Function to initialize image click modal functionality
            function initImageModal() {
                const modal = document.getElementById("imageModal");
                const modalImage = document.getElementById("modalImage");
                const closeModal = document.getElementById("closeModal");

                // Add click listeners to all product images
                document.querySelectorAll(".product-image").forEach(function (img) {
                    img.addEventListener("click", function () {
                        // Set the modal's image source to the clicked image's source
                        modalImage.src = img.src;
                        // Display the modal
                        modal.classList.remove("hidden");
                    });
                });

                // Close modal on clicking the close button
                closeModal.addEventListener("click", function () {
                    modal.classList.add("hidden");
                });

                // Close modal if user clicks outside the modal content
                modal.addEventListener("click", function (e) {
                    if (e.target === modal) {
                        modal.classList.add("hidden");
                    }
                });
            }

            // Initialize the modal functionality once the DOM is loaded
            initImageModal();
        });

    </script>


    <?php if (isset($_SESSION['flash'])): ?>
        <script>
            Swal.fire({
                icon: '<?= $_SESSION['flash']['type'] ?>',
                title: '<?= $_SESSION['flash']['message'] ?>',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    <?php unset($_SESSION['flash']); endif; ?>

</body>
</html>
