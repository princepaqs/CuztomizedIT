<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CuztomizeIT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/png" href="assets/cuzlogo.jpg">
</head>
<body class="">
  
  <div class="h-screen flex">

    <div class="flex flex-col min-w-0 flex-1  ">
     
      <nav class="fixed top-0 left-0 right-0 z-50 lg:flex items-center justify-between lg:flex-wrap bg-[#272c2b] py-2 px-8 shadow-lg lg:block hidden m-2 rounded-lg">
        <div class="flex items-center flex-shrink-0 text-[#f99810] mr-6 gap-4">
        <img class="w-12 h-10" src="./assets/cuzlogo.jpg">
          <div class="flex flex-col font-semibold">
            <span class="font-semibold text-3xl tracking-tight flex flex-row">Cuztomize<p class="text-white">IT</p> </span>
            <span class="text-[11px] text-white flex flex-row gap-1"> “We <p class="text-orange-500"><i>BUILD</i></p> the <p class="text-red-500 font-semibold"><i>RIGHT</i></p> Solution!”</span>
          </div>
        </div>
        <div class="block lg:hidden">
          <button id="sidebar-toggle" class="flex items-center px-3 py-2 text-white ">
            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <title>Menu</title>
              <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
            </svg>
          </button>
        </div>
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto justify-end menu-links hidden sidebar pr-28 mr-20">
          <div class="text-sm lg:flex gap-10">
            <div>
              <a href="#home" class="flex flex-row items-center text-white hover:text-[#f99810] gap-1 cursor-pointer">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
              </svg>
                Home
              </a>
            </div>
            <div class="">
              <a href="#product" class="flex flex-row items-center text-white hover:text-[#f99810] gap-1 cursor-pointer">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
              </svg>

                Products
              </a>
            </div>
            <div>
              <a href="#faq" class="flex flex-row items-center text-white hover:text-[#f99810] gap-1 cursor-pointer">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"></path></svg>
                FAQ
              </a>
            </div>
          </div>
        </div>
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto justify-end menu-links hidden sidebar">
          <div class="text-[10px] lg:text-xs lg:flex gap-5">
            <a href="#contact" class="flex flex-row items-center text-white hover:text-[#f99810] gap-1 cursor-pointer">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4"><path fill-rule="evenodd" d="M4.5 3.75a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V6.75a3 3 0 0 0-3-3h-15Zm4.125 3a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Zm-3.873 8.703a4.126 4.126 0 0 1 7.746 0 .75.75 0 0 1-.351.92 7.47 7.47 0 0 1-3.522.877 7.47 7.47 0 0 1-3.522-.877.75.75 0 0 1-.351-.92ZM15 8.25a.75.75 0 0 0 0 1.5h3.75a.75.75 0 0 0 0-1.5H15ZM14.25 12a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H15a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5h3.75a.75.75 0 0 0 0-1.5H15Z" clip-rule="evenodd"></path></svg>
              Contact Us
            </a>
          </div>
        </div>
      </nav>

      <div class="flex items-center justify-center w-1/2">
        <div class="fixed bottom-0 left-0 right-0 z-50 text-white lg:hidden bg-[#272c2b] py-4 px-10 m-2 rounded-lg shadow-lg flex justify-between items-center">
        <div class="flex flex-row items-center justify-center md:justify-between gap-10 w-full" >
          <div class="flex items-center flex-shrink-0 text-[#f99810] mr-6 hidden md:flex">
          
            <span class="font-bold text-lg tracking-tight ">CuztomizeIT</span>
          </div>
          <div class="flex items-center justify-between gap-10">
            <div>
              <a href="#home" class="flex flex-row items-center text-white hover:text-[#f99810] gap-1 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 md:size-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <p class="hidden md:flex text-sm">Home</p>
              </a>
            </div>
            <div class="">
              <a href="#product" class="flex flex-row items-center text-white hover:text-[#f99810] gap-1 cursor-pointer">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 md:size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
              </svg>
                <p class="hidden md:flex text-sm">Product</p>
              </a>
            </div>
            <div>
              <a href="#faq" class="flex flex-row items-center text-white hover:text-[#f99810] gap-1 cursor-pointer">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6 md:size-4"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"></path></svg>
                <p class="hidden md:flex text-sm">FAQ</p>
              </a>
            </div>
          </div>
          <div class="">
              <a href="#contact" class="flex flex-row items-center text-white hover:text-[#f99810] gap-1 cursor-pointer">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 md:size-4"><path fill-rule="evenodd" d="M4.5 3.75a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V6.75a3 3 0 0 0-3-3h-15Zm4.125 3a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Zm-3.873 8.703a4.126 4.126 0 0 1 7.746 0 .75.75 0 0 1-.351.92 7.47 7.47 0 0 1-3.522.877 7.47 7.47 0 0 1-3.522-.877.75.75 0 0 1-.351-.92ZM15 8.25a.75.75 0 0 0 0 1.5h3.75a.75.75 0 0 0 0-1.5H15ZM14.25 12a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H15a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5h3.75a.75.75 0 0 0 0-1.5H15Z" clip-rule="evenodd"></path></svg>
                <p class="hidden md:flex text-sm">Contact Us</p>
                </a>
            </div>
          </div>
        </div>
      </div>


      <div class="fixed top-0 left-0 right-0 z-50 bg-[#272c2b] rounded-lg m-2">
          <div class="flex items-center flex-shrink-0 text-[#f99810] mr-6 p-4 md:hidden lg:hidden">
            <span class="font-bold text-lg tracking-tight ">CuztomizeIT</span>
          </div>
      </div>



      <div class="overflow-auto">
  
        <div>
        <div class="slider h-[100svh] lg:h-[100svh] relative">
  
          <div id="home" class="slider-images">
            <img class="slider-image" src="./assets/product1.jpg" alt="Product 1">
            <img class="slider-image" src="./assets/product2.jpg" alt="Product 2">
            <img class="slider-image" src="./assets/product4.jpg" alt="Product 4">
            <img class="slider-image" src="./assets/product5.jpg" alt="Product 5">
            <img class="slider-image" src="./assets/product6.jpg" alt="Product 6">
          </div>

          <button class="slider-button prev">❮</button>
          <button class="slider-button next">❯</button>
          <div class="tagline absolute inset-0 flex items-center justify-center text-white text-2xl lg:text-4xl font-bold">
            <!-- Tagline will be dynamically inserted here -->
          </div>
          <div class="slider-overlay"></div>
        </div>

            <div class="flex flex-col item-center justify-centergap-2 pt-10 mx-10  lg:pt-20  lg:mx-28">
            <h1 class="text-lg lg:text-2xl font-bold text-start py-5 ">Welcome to CuztomizeIT</h1>
            <p class="text-xs text-gray-700 lg:text-sm font-normal">At CuztomizeIT, we specialize in delivering high-quality digital solutions that empower businesses across industries. From custom websites to mobile apps, we create user-centric, innovative, and scalable systems that drive real impact. Our team of expert developers, designers, and project managers works closely with clients to deliver tailored solutions that exceed expectations. Whether you need a website, mobile app, or system integration, we ensure functional, engaging, and efficient results. With a focus on quality, transparency, and customer satisfaction, we build long-lasting partnerships to help your business thrive in the digital world. Let us bring your ideas to life and elevate your digital presence.</p>
          </div>
        </div>


       <!-- Our product -->
       <div  id="product"  class="flex flex-col py-16 mx-10 lg:py-20 lg:mx-28">
        <h1 class="text-lg lg:text-2xl font-bold pb-4 text-start mt-5">Products</h1>

        <div class=" lg:flex w-full relative">
          <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 duration-300 gap-5" id="large-slider">

            
            <div class="flex-none flex flex-col items-center justify-center">
              <img class="w-full h-40 object-cover rounded-md" src="./assets/platform1.jpg" alt="Product 1">
              <p class="font-semibold text-gray-600 text-sm">Business/Corporate Website</p>
            </div>

            <div class="flex-none flex flex-col items-center justify-center">
              <img class="w-full h-40 object-cover rounded-md" src="./assets/mobile-app.jpg" alt="Product 2">
              <p class="font-semibold text-gray-600 text-sm">Mobile Application</p>
              
            </div>

            <div class="flex-none flex flex-col items-center justify-center">
              <img class="w-full h-40 object-cover rounded-md" src="./assets/real-estate.jpg" alt="Product 1">
              <p class="font-semibold text-gray-600 text-sm">Real Estate Software</p>
            </div>

            <div class="flex-none flex flex-col items-center justify-center">
              <img class="w-full h-40 object-cover rounded-md" src="./assets/accounting.jpg" alt="Product 1">
              <p class="font-semibold text-gray-600 text-sm">Accounting Software</p>
            </div>

            <div class="flex-none flex flex-col items-center justify-center">
              <img class="w-full h-40 object-cover rounded-md" src="./assets/cuz-software.jpg" alt="Product 1">
              <p class="font-semibold text-gray-600 text-sm">Cuztomize Software</p>
            </div>
        </div>
      </div>

        <!-- FAQ Section -->
        <div id="faq" class=" pt-28 w-full" >
        <section class="">
          <h2 class="text-2xl lg:text-2xl font-bold text-start mb-6">Frequently Asked Questions</h2>
          <div class="space-y-4 text-sm">
            <div class="border-b pb-4">
              <h3 class="font-semibold text-gray-700">1. What product do you offer?</h3>
              <p class="text-gray-600">We offer a range of product including web development, mobile app development, vertical and custom software solutions.</p>
            </div>
            <div class="border-b pb-4">
              <h3 class="font-semibold text-gray-700">2. How long does a project typically take?</h3>
              <p class="text-gray-600">Project timelines vary based on complexity, but we provide a detailed timeline during the initial consultation.</p>
            </div>
            <div class="border-b pb-4">
              <h3 class="font-semibold text-gray-700">3. Do you offer ongoing support?</h3>
              <p class="text-gray-600">Yes, we provide annual maintenance support via telephone/online support and also onsite visit.</p>
            </div>
            <div class="border-b pb-4">
              <h3 class="font-semibold text-gray-700">4. Did you offer a support demo?</h3>
              <p class="text-gray-600">Yes, we can provide a support demo for our product, contact or email us in <a href="https://mail.google.com/mail/?view=cm&fs=1&to=sales@cuztomizeit.com" class="text-[#f99810] underline" target="_blank" rel="noopener noreferrer">sales@cuztomizeit.com</a> for schedule.
              </p>
            </div>
          </div>
        </section>
        </div>

  
        <div id="contact" class="flex flex-col items-center justify-center pb-20 pt-28 ">F
          <div class="w-full">
            <h1 class="text-2xl lg:text-2xl font-bold text-start">Contact Us</h1>     
            <div class="py-4 flex items-center justify-center">
            <iframe
            class="rounded-md w-2/3 h-[200px] lg:h-[500px] pointer-events-none"
             src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28305.320686197756!2d120.9733543395929!3d14.746679626925388!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b18f6401438d%3A0x30e71aa2fddf0c66!2sBignay%2C%20Kalakhang%20Maynila!5e0!3m2!1sfil!2sph!4v1744433067055!5m2!1sfil!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
 
            </div>
            <div class="text-center py-4">
            <p>Have any questions or concerns? Feel free to reach out to us!</p>
              <a href="https://mail.google.com/mail/?view=cm&fs=1&to=sales@cuztomizeit.com" class="text-[#f99810] underline" target="_blank" rel="noopener noreferrer">Click here to email us</a>
            </div>
          </div>
        </div>


   
      </div>
      <footer class="w-full lg:px-20 pt-5 lg:pt-10 pb-14 md:pb-14 lg:pb-0 bg-[#272c2b]">
    <div class="flex flex-col lg:flex-row items-center justify-between text-white pb-5">
      <div class="h-1/3 w-full lg:w-1/3 px-10 lg:px-28 py-2">
        <h1 class="text-xl pb-4 font-bold">CuztomizeIT</h1>
        <p class="text-sm">Bignay, Valenzuela City</p>
      </div>
      <div class="h-1/3 w-full lg:w-1/3 flex flex-col px-10 py-2">
        <h1 class="text-xl pb-4 font-bold">Contact Us</h1>
        <p class="text-sm">sales@cuztomizeit.com</p>
        <p class="text-sm">Tel. # (02) 8671-1778</p>
      </div>
      <div class="h-1/3 w-full lg:w-1/3 flex flex-col px-10 py-2">
        <h1 class="text-xl pb-4 font-bold">We are social</h1>
        <div class="flex flex-col items-start">
          <div class="flex flex-row items-center justify-start gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0,0,256,256">
              <g fill="#ffffff">
                <g transform="scale(10.66667,10.66667)">
                  <path d="M17.525,9h-3.525v-2c0,-1.032 0.084,-1.682 1.563,-1.682h1.868v-3.18c-0.909,-0.094 -1.823,-0.14 -2.738,-0.138c-2.713,0 -4.693,1.657 -4.693,4.699v2.301h-3v4l3,-0.001v9.001h4v-9.003l3.066,-0.001z"></path>
                </g>
              </g>
            </svg>
            <a class="text-xs" href="https://cuztomizeit.com/index.html">Webpage</a>
          </div>
          <!-- <div class="flex flex-row items-center justify-start gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0,0,256,256">
              <g fill="#ffffff">
                <g transform="scale(8,8)">
                  <path d="M8.64258,4c-1.459,0 -2.64258,1.18163 -2.64258,2.64063c0,1.459 1.18262,2.66797 2.64063,2.66797c1.458,0 2.64258,-1.20897 2.64258,-2.66797c0,-1.458 -1.18163,-2.64062 -2.64062,-2.64062zM21.53516,11c-2.219,0 -3.48866,1.16045 -4.09766,2.31445h-0.06445v-2.00391h-4.37305v14.68945h4.55664v-7.27148c0,-1.916 0.14463,-3.76758 2.51563,-3.76758c2.337,0 2.37109,2.18467 2.37109,3.88867v7.15039h4.55078h0.00586v-8.06836c0,-3.948 -0.84884,-6.93164 -5.46484,-6.93164zM6.36328,11.31055v14.68945h4.56055v-14.68945z"></path>
                </g>
              </g>
            </svg>
            <a class="text-xs" href="https://www.linkedin.com/in/prince-louie-paquiado-4748b0326/">LinkedIn</a>
          </div>
          <div class="flex flex-row items-center justify-start gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0,0,256,256">
              <g fill="#ffffff">
                <g transform="scale(5.12,5.12)">
                  <path d="M6.91992,6l14.2168,20.72656l-14.9082,17.27344h3.17773l13.13867,-15.22266l10.44141,15.22266h10.01367l-14.87695,-21.6875l14.08008,-16.3125h-3.17578l-12.31055,14.26172l-9.7832,-14.26172z"></path>
                </g>
              </g>
            </svg>
            <a class="text-sm" href="https://x.com/PrinceYGG">Twitter</a>
          </div> -->
        </div>
      </div>
    </div>
  <!-- Copyright section -->
  <div class="flex justify-center text-sm text-gray-400 border-t border-gray-600 py-5 px-10 ">
    <p>&copy; 2025 CuztomizeIT. All rights reserved.</p>
  </div>
</footer>   
    </div>
  </div>
  <script src="script.js" >
  </script>
</body>
</html>