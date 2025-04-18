<?php
session_start();
$current_page = basename($_SERVER['PHP_SELF']);
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

// Sample product data (replace with database fetch)
$services = [
    ['id' => 1, 'name' => 'Product A', 'category' => 'Electronics', 'date' => '14/04/25'],
    ['id' => 2, 'name' => 'Product B', 'category' => 'Books', 'date' => '14/04/25'],
    ['id' => 3, 'name' => 'Product C', 'category' => 'Clothing', 'date' => '14/04/25']
];

// Get unique categories
$categories = array_unique(array_column($services, 'category'));
sort($categories);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Services</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Sidebar -->
    <div class="flex">
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

            <h2 class="text-3xl text-gray-800 mb-6 font-bold">Services</h2>

            <!-- Overview -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
                <div class="bg-white p-4 rounded shadow text-center">
                    <h2 class="text-xl font-semibold">Total Services</h2>
                    <p class="text-2xl text-[#f59002] font-bold"><?php echo count($services); ?></p>
                </div>
                <div class="bg-white p-4 rounded shadow text-center">
                    <h2 class="text-xl font-semibold">Categories</h2>
                    <p class="text-2xl text-[#f59002] font-bold">3</p>
                </div>
                <div class="bg-white p-4 rounded shadow text-center">
                    <h2 class="text-xl font-semibold">Available Service</h2>
                    <p class="text-2xl text-[#f59002] font-bold">1</p>
                </div>
            </div>

            <!-- Search and Add Product -->
            <div class="flex items-center justify-between pt-4 gap-2">

            <!-- Category Filter Buttons -->
                <div id="filter-buttons" class="flex flex-row gap-2 text-sm">
                    <button class="filter-btn py-2 rounded bg-white border hover:bg-orange-100 w-[100px]" data-category="All">All</button>
                    <?php foreach ($categories as $cat): ?>
                        <button class="filter-btn py-2 rounded bg-white border hover:bg-orange-100 w-[100px]"
                                data-category="<?= htmlspecialchars($cat) ?>">
                            <?= htmlspecialchars($cat) ?>
                        </button>
                    <?php endforeach; ?>
                </div>
                    
                <div class="flex flex-row gap-5">
                    <input type="text" id="searchInput" placeholder="Search product..." class="py-1 px-2 outline-none text-sm border border-gray-300 rounded" />
                    <a href="add_product.php" class="bg-[#f59002] hover:bg-orange-500 text-white px-4 py-2 rounded shadow text-sm">+ Add New Services</a>
                </div>
            </div>

            <!-- Product Table -->
            <div class="bg-white rounded shadow overflow-x-auto mt-2">
                <table class="min-w-full table-auto text-left" id="productTable">
                    <thead class="bg-[#272c2b] text-white">
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Category</th>
                            <th class="px-4 py-2">Date</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="product-table">
                    <?php foreach ($services as $product): ?>
                        <tr class="border-t" data-category="<?= htmlspecialchars($product['category']) ?>">
                            <td class="px-4 py-2"><?= $product['id'] ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($product['name']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($product['category']) ?></td>
                            <td class="px-4 py-2"><?= $product['date'] ?></td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="edit_product.php?id=<?php echo $product['id']; ?>" class="text-blue-600 hover:underline">Edit</a>
                                    <a href="delete_product.php?id=<?php echo $product['id']; ?>" class="text-red-600 hover:underline" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script>
        const buttons = document.querySelectorAll('.filter-btn');
        const rows = document.querySelectorAll('#product-table tr');

        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                // Highlight active button
                buttons.forEach(b => b.classList.remove('bg-orange-400', 'text-white'));
                btn.classList.add('bg-orange-400', 'text-white');

                const category = btn.getAttribute('data-category');

                rows.forEach(row => {
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

    <!-- Date & Time Script -->
    <script>
        function updateDateTime() {
            const now = new Date();
            const formatted = now.toLocaleString('en-US', {
                weekday: 'short',
                year: 'numeric',
                month: 'short',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            });
            document.getElementById('datetime').textContent = formatted;
        }
        setInterval(updateDateTime, 1000);
        updateDateTime();
    </script>


    <!-- SweetAlert2 Logout -->
    <script>
        document.getElementById('logoutBtn').addEventListener('click', function () {
            Swal.fire({
                title: 'Are you sure?',
                text: "You will be logged out.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, logout'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'logout.php';
                }
            });
        });
    </script>

    <!-- Live Search Script -->
    <script>
        const searchInput = document.getElementById('searchInput');
        const productTable = document.getElementById('productTable');
        const rows = productTable.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

        searchInput.addEventListener('input', function () {
            const searchTerm = searchInput.value.toLowerCase();

            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let match = false;

                for (let j = 0; j < cells.length - 1; j++) { // Exclude actions column
                    const cellText = cells[j].textContent.toLowerCase();
                    if (cellText.includes(searchTerm)) {
                        match = true;
                        break;
                    }
                }

                rows[i].style.display = match ? '' : 'none';
            }
        });
    </script>

</body>
</html>
