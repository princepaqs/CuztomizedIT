let smallIndex = 0;
let largeIndex = 0;

function nextSlide(sliderId) {
  const slider = document.getElementById(sliderId);
  const slides = slider.children;
  const totalSlides = slides.length;

  if (sliderId === 'small-slider') {
    smallIndex = (smallIndex + 1) % totalSlides;
    slider.style.transform = `translateX(-${smallIndex * (300/ 4)}%)`;
  } else {
    largeIndex = (largeIndex + 1) % totalSlides;
    slider.style.transform = `translateX(-${largeIndex * (100 / 10)}%)`;
  }
}

function prevSlide(sliderId) {
  const slider = document.getElementById(sliderId);
  const slides = slider.children;
  const totalSlides = slides.length;

  if (sliderId === 'small-slider') {
    smallIndex = (smallIndex - 1 + totalSlides) % totalSlides;
    slider.style.transform = `translateX(-${smallIndex * (100 / 4)}%)`;
  } else {
    largeIndex = (largeIndex - 1 + totalSlides) % totalSlides;
    slider.style.transform = `translateX(-${largeIndex * (100 / 4)}%)`;
  }
}

    document.addEventListener("DOMContentLoaded", function () {
    const sidebarToggle = document.getElementById("sidebar-toggle");
    const sidebar = document.querySelector(".sidebar");
    const sidebarLinks = sidebar.querySelectorAll("a");
  
    sidebarToggle.addEventListener("click", function () {
      sidebar.classList.toggle("hidden");
    });
  

    sidebarLinks.forEach(link => {
      link.addEventListener("click", function () {
        sidebar.classList.add("hidden");
      });
    });
  
    document.addEventListener("click", function (event) {
      if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
        sidebar.classList.add("hidden");
      }
    });

    const sliderImages = document.querySelector(".slider-images");
    const slides = document.querySelectorAll(".slider-image");
    const prevButton = document.querySelector(".slider-button.prev");
    const nextButton = document.querySelector(".slider-button.next");
    const taglineElement = document.querySelector(".tagline");
  
    let currentIndex = 0;
    const totalSlides = slides.length;
    const slideInterval = 3000; // Interval time in milliseconds (3 seconds)
  
  
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
  
    setInterval(nextSlide, slideInterval);
  

    updateTagline();
  });
  