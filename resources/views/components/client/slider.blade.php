<!-- Slider Simple -->
<div class="px-4 sm:px-6 lg:px-8 py-10">
  <div class="relative w-full h-96 md:h-[500px] bg-gray-900 rounded-2xl overflow-hidden" id="heroSlider">
    <div class="relative w-full h-full">
      <!-- Slide 1 -->
      <div class="slider-slide absolute inset-0 w-full h-full transition-opacity duration-1000">
        <div class="w-full h-full bg-cover bg-center bg-no-repeat" style="background-image: url('https://fr.mobiletransaction.org/wp-content/uploads/sites/11/2020/09/meilleur-site-ecommerce.jpg.webp')">
          <div class="w-full h-full bg-black bg-opacity-40 flex items-end">
            <div class="w-full md:w-2/3 p-6 md:p-10">
              <span class="block text-yellow-400 font-semibold text-lg mb-2">Special Offer</span>
              <h2 class="text-white text-2xl md:text-4xl font-bold mb-4">SuperMarket For Fresh Grocery</h2>
              <p class="text-white mb-6">Introduced a new model for online grocery shopping and convenient home delivery.</p>
              <a href="#" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Shop Now
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="slider-slide absolute inset-0 w-full h-full transition-opacity duration-1000 opacity-0">
        <div class="w-full h-full bg-cover bg-center bg-no-repeat" style="background-image: url('https://www.leparisien.fr/resizer/4bXhPUS8mrJJXzc-gYc4IN8LN68=/arc-photo-lpguideshopping/eu-central-1-prod/public/BURDULPF6EYWLORJXHUUKCVWPE.jpg')">
          <div class="w-full h-full bg-black bg-opacity-40 flex items-end">
            <div class="w-full md:w-2/3 p-6 md:p-10">
              <span class="block text-green-400 font-semibold text-lg mb-2">Fresh Products</span>
              <h2 class="text-white text-2xl md:text-4xl font-bold mb-4">Quality You Can Trust</h2>
              <p class="text-white mb-6">Discover our selection of fresh organic products delivered to your door.</p>
              <a href="#" class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                Explore Products
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Slide 3 -->
      <div class="slider-slide absolute inset-0 w-full h-full transition-opacity duration-1000 opacity-0">
        <div class="w-full h-full bg-cover bg-center bg-no-repeat" style="background-image: url('https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=1920&auto=format&fit=crop')">
          <div class="w-full h-full bg-black bg-opacity-40 flex items-end">
            <div class="w-full md:w-2/3 p-6 md:p-10">
              <span class="block text-purple-400 font-semibold text-lg mb-2">Fast Delivery</span>
              <h2 class="text-white text-2xl md:text-4xl font-bold mb-4">Shop From Home</h2>
              <p class="text-white mb-6">Get your groceries delivered in minutes with our express delivery service.</p>
              <a href="#products" onclick="document.getElementById('products').scrollIntoView({behavior: 'smooth'})" class="inline-flex items-center px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                Start Shopping
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Navigation arrows -->
    <button onclick="previousSlide()" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-20 hover:bg-opacity-30 text-white p-3 rounded-full transition">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
      </svg>
    </button>
    <button onclick="nextSlide()" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-20 hover:bg-opacity-30 text-white p-3 rounded-full transition">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
      </svg>
    </button>

    <!-- Navigation dots -->
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
      <button onclick="goToSlide(0)" class="slider-dot w-3 h-3 bg-white rounded-full opacity-100 transition"></button>
      <button onclick="goToSlide(1)" class="slider-dot w-3 h-3 bg-white rounded-full opacity-50 transition"></button>
      <button onclick="goToSlide(2)" class="slider-dot w-3 h-3 bg-white rounded-full opacity-50 transition"></button>
    </div>
  </div>
</div>
<!-- End Slider Simple -->

<script>
let currentSlide = 0;
const slides = document.querySelectorAll('.slider-slide');
const dots = document.querySelectorAll('.slider-dot');
const totalSlides = slides.length;

function showSlide(index) {
  // Hide all slides
  slides.forEach(slide => slide.classList.add('opacity-0'));
  dots.forEach(dot => dot.classList.remove('opacity-100'));
  dots.forEach(dot => dot.classList.add('opacity-50'));
  
  // Show current slide
  slides[index].classList.remove('opacity-0');
  dots[index].classList.remove('opacity-50');
  dots[index].classList.add('opacity-100');
  
  currentSlide = index;
}

function nextSlide() {
  const nextIndex = (currentSlide + 1) % totalSlides;
  showSlide(nextIndex);
}

function previousSlide() {
  const prevIndex = (currentSlide - 1 + totalSlides) % totalSlides;
  showSlide(prevIndex);
}

function goToSlide(index) {
  showSlide(index);
}

// Auto-play
setInterval(nextSlide, 5000);

// Initialize first slide
showSlide(0);
</script>
