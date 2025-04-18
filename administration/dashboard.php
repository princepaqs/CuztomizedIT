<?php
session_start();
$current_page = basename($_SERVER['PHP_SELF']);
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

require_once 'get_products.php'; 
require_once '../visitor.php';
$products = getProducts();
$visitCount = getVisitorCount();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">

<div class="flex">

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
    <div class="flex-1 p-10 relative">

        <!-- Top-right Date & Time -->
        <div class="absolute right-10 top-10 text-sm text-gray-600 font-medium">
            <span id="datetime"></span>
        </div>

        <h2 class="text-3xl text-gray-800 mb-6 font-bold">Welcome to Admin Dashboard</h2>

        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h3 class="text-2xl mb-4">Hello, <?php echo htmlspecialchars($_SESSION['admin']); ?> 👋</h3>
            <p class="text-gray-700">Manage your products, services, and etc.</p>
        </div>

        <!-- Dashboard Cards -->
        <!-- backgroundColor: ['#32a852', '#f59002'],
        backgroundColor: '#328ba8', -->
        <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-5 rounded-lg shadow-md flex flex-row items-center justify-between w-full gap-5">
                <div class="w-24 h-24 flex items-center justify-center  bg-[#32a852] rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-white size-12">
                <path fill-rule="evenodd" d="M1.5 9.832v1.793c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875V9.832a3 3 0 0 0-.722-1.952l-3.285-3.832A3 3 0 0 0 16.215 3h-8.43a3 3 0 0 0-2.278 1.048L2.222 7.88A3 3 0 0 0 1.5 9.832ZM7.785 4.5a1.5 1.5 0 0 0-1.139.524L3.881 8.25h3.165a3 3 0 0 1 2.496 1.336l.164.246a1.5 1.5 0 0 0 1.248.668h2.092a1.5 1.5 0 0 0 1.248-.668l.164-.246a3 3 0 0 1 2.496-1.336h3.165l-2.765-3.226a1.5 1.5 0 0 0-1.139-.524h-8.43Z" clip-rule="evenodd" />
                <path d="M2.813 15c-.725 0-1.313.588-1.313 1.313V18a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3v-1.688c0-.724-.588-1.312-1.313-1.312h-4.233a3 3 0 0 0-2.496 1.336l-.164.246a1.5 1.5 0 0 1-1.248.668h-2.092a1.5 1.5 0 0 1-1.248-.668l-.164-.246A3 3 0 0 0 7.046 15H2.812Z" />
                </svg>

                </div>

                <div class="w-3/4 h-24 flex flex-col justify-between ">
                    <h4 class="text-lg font-bold text-gray-700 text-start">Products</h4>
                    <p class="text-5xl text-[#f59002] font-semibold text-end"><?php echo count($products); ?></p>
                </div>
            </div>
            <div class="bg-white p-5 rounded-lg shadow-md flex flex-row items-center justify-between w-full gap-5">
                <div class="w-24 h-24 flex items-center justify-center  bg-[#f59002] rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-12 text-white">
                <path d="M6 12a.75.75 0 0 1-.75-.75v-7.5a.75.75 0 1 1 1.5 0v7.5A.75.75 0 0 1 6 12ZM18 12a.75.75 0 0 1-.75-.75v-7.5a.75.75 0 0 1 1.5 0v7.5A.75.75 0 0 1 18 12ZM6.75 20.25v-1.5a.75.75 0 0 0-1.5 0v1.5a.75.75 0 0 0 1.5 0ZM18.75 18.75v1.5a.75.75 0 0 1-1.5 0v-1.5a.75.75 0 0 1 1.5 0ZM12.75 5.25v-1.5a.75.75 0 0 0-1.5 0v1.5a.75.75 0 0 0 1.5 0ZM12 21a.75.75 0 0 1-.75-.75v-7.5a.75.75 0 0 1 1.5 0v7.5A.75.75 0 0 1 12 21ZM3.75 15a2.25 2.25 0 1 0 4.5 0 2.25 2.25 0 0 0-4.5 0ZM12 11.25a2.25 2.25 0 1 1 0-4.5 2.25 2.25 0 0 1 0 4.5ZM15.75 15a2.25 2.25 0 1 0 4.5 0 2.25 2.25 0 0 0-4.5 0Z" />
                </svg>


                </div>

                <div class="w-3/4 h-24 flex flex-col justify-between ">
                    <h4 class="text-lg font-bold text-gray-700 text-start">Services</h4>
                    <p class="text-5xl text-[#f59002] font-semibold text-end"><?php echo count($products); ?></p>
                </div>
            </div>
            <div class="bg-white p-5 rounded-lg shadow-md flex flex-row items-center justify-between w-full gap-5">
                <div class="w-24 h-24 flex items-center justify-center  bg-[#328ba8] rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-12 text-white">
  <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
  <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
</svg>


                </div>

                <div class="w-3/4 h-24 flex flex-col justify-between ">
                    <h4 class="text-lg font-bold text-gray-700 text-start">Visitors</h4>
                    <p class="text-5xl text-[#f59002] font-semibold text-end"><?php echo $visitCount; ?></p>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">
            <!-- Pie Chart -->
            <div class="bg-white p-5 rounded-lg shadow-md">
                <h4 class="text-lg font-semibold text-gray-700 mb-4">Product & Service Distribution</h4>
                <div class="w-full flex justify-center">
                    <canvas id="pieChart" class="max-w-[300px] max-h-[300px]"></canvas>
                </div>
            </div>

            <!-- Bar Chart -->
            <div class="bg-white p-5 rounded-lg shadow-md">
                <h4 class="text-lg font-semibold text-gray-700 mb-4">Monthly Visitors</h4>
                <div class="w-full overflow-x-auto">
                    <canvas id="barChart" class="w-full max-h-[300px]"></canvas>
                </div>
            </div>
        </div>

            </div>
        </div>

    <script src="script.js" ></script>
    <script>
        //pie chart
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Products', 'Services'],
                datasets: [{
                    label: 'Count',
                    data: [<?php echo count($products); ?>, <?php echo count($products); ?>],
                    backgroundColor: ['#32a852', '#f59002'],
                    borderWidth: 1
                }]
            }
        });

        // Bar Chart
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Visitors',
                    data: [45, 78, 60, 128, , , , , , , , ], // Sample data
                    backgroundColor: '#328ba8',
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 20
                        }
                    }
                }
            }
        });
    </script>

</body>
</html>
