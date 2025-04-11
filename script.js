let smallIndex = 0;
let largeIndex = 0;

function nextSlide(sliderId) {
  const slider = document.getElementById(sliderId);
  const slides = slider.children;
  const totalSlides = slides.length;

  if (sliderId === 'small-slider') {
    smallIndex = (smallIndex + 1) % totalSlides;
    slider.style.transform = `translateX(-${smallIndex * (300/ 4)}%)`; // Adjust for width
  } else {
    largeIndex = (largeIndex + 1) % totalSlides;
    slider.style.transform = `translateX(-${largeIndex * (100 / 10)}%)`; // Adjust for width
  }
}

function prevSlide(sliderId) {
  const slider = document.getElementById(sliderId);
  const slides = slider.children;
  const totalSlides = slides.length;

  if (sliderId === 'small-slider') {
    smallIndex = (smallIndex - 1 + totalSlides) % totalSlides;
    slider.style.transform = `translateX(-${smallIndex * (100 / 4)}%)`; // Adjust for width
  } else {
    largeIndex = (largeIndex - 1 + totalSlides) % totalSlides;
    slider.style.transform = `translateX(-${largeIndex * (100 / 4)}%)`; // Adjust for width
  }
}

    document.addEventListener("DOMContentLoaded", function () {
    const sidebarToggle = document.getElementById("sidebar-toggle");
    const sidebar = document.querySelector(".sidebar");
    const sidebarLinks = sidebar.querySelectorAll("a");
  
    sidebarToggle.addEventListener("click", function () {
      sidebar.classList.toggle("hidden");
    });
  
    // Close the sidebar when clicking on a link
    sidebarLinks.forEach(link => {
      link.addEventListener("click", function () {
        sidebar.classList.add("hidden");
      });
    });
  
    // Close the sidebar when clicking outside of it
    document.addEventListener("click", function (event) {
      if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
        sidebar.classList.add("hidden");
      }
    });
  
    // Image slider functionality
    const sliderImages = document.querySelector(".slider-images");
    const slides = document.querySelectorAll(".slider-image");
    const prevButton = document.querySelector(".slider-button.prev");
    const nextButton = document.querySelector(".slider-button.next");
    const taglineElement = document.querySelector(".tagline");
  
    let currentIndex = 0;
    const totalSlides = slides.length;
    const slideInterval = 3000; // Interval time in milliseconds (3 seconds)
  
    // Array of taglines
    const taglines = [
      "Innovate with Us!",
      "Your Vision, Our Expertise",
      "Building the Future Together",
      "Quality Solutions for Your Needs",
      "Empowering Your Business",
      "Excellence in Every Project"
    ];
  
    function showSlide(index) {
      const offset = -index * 100;
      sliderImages.style.transform = `translateX(${offset}%)`;
      updateTagline();
    }
  
    function nextSlide() {
      currentIndex = (currentIndex < totalSlides - 1) ? currentIndex + 1 : 0;
      showSlide(currentIndex);
    }
  
    function prevSlide() {
      currentIndex = (currentIndex > 0) ? currentIndex - 1 : totalSlides - 1;
      showSlide(currentIndex);
    }
  
    function updateTagline() {
      const randomIndex = Math.floor(Math.random() * taglines.length);
      taglineElement.textContent = taglines[randomIndex];
    }
  
    prevButton.addEventListener("click", prevSlide);
    nextButton.addEventListener("click", nextSlide);
  
    // Auto-slide functionality
    setInterval(nextSlide, slideInterval);
  
    // Initialize tagline on page load
    updateTagline();
  });
  