@props(['categories'])
<section class="mt-8 border-l-orange-600 max-h-[500px] overflow-hidden">
	<div class="container">
		<div class="flex flex-wrap mb-4">
			<div class="w-full">
				<h2 class="text-2xl font-bold">Featured Categories</h2>
			</div>
		</div>
		<!-- static table img for test only -->
		@php
		$categoryImages = [
		'assets/images/category/category-cleaning-essentials.jpg',
		'assets/images/category/category-tea-coffee-drinks.jpg',
		'assets/images/category/category-instant-food.jpg',
		'assets/images/category/category-bakery-biscuits.jpg',
		'assets/images/category/category-cleaning-essentials.jpg',
		'assets/images/category/category-dairy-bread-eggs.jpg',
		'assets/images/category/category-snack-munchies.jpg',
		'assets/images/category/category-baby-care.jpg',
		'assets/images/category/category-chicken-meat-fish.jpg',
		'assets/images/category/category-pet-care.jpg',
		'',
		];
		@endphp

		<div class="swiper relative" id="swiper-categories">
			<div class="swiper-wrapper  py-12 lg:grid lg:grid-cols-5 lg:gap-4 lg:swiper-wrapper-none">
				@foreach ($categories as $index => $category)
				<div class="swiper-slide lg:static">
					<a href="#!">
						<div class="relative border-b-green-500 rounded-lg break-words border bg-white border-gray-300 transition duration-300 hover:border-green-600 hover:shadow-md">
							<div class="py-4 text-center h-60 md:h-72 lg:h-auto flex flex-col justify-center">
								<img src="{{ asset($categoryImages[$index] ?? 'assets/images/category/default.jpg') }}"
									alt="{{ $category->name }}"
									class="mb-3 m-auto h-24 w-24 object-contain" />
								<div class="text-base font-semibold">{{$category->name}}</div>
								<div class="text-base text-gray-500">{{$category->description}}</div>
							</div>
						</div>
					</a>
				</div>
				@endforeach
			</div>
			<div class="swiper-pagination"></div>
		</div>
	</div>
</section>



<section>
	<div class="container">
		<div class="flex md:space-x-2 lg:space-x-6 flex-wrap md:flex-nowrap">
			<div class="w-full md:w-1/2 mb-3 lg:">
				<div class="py-10 px-8 rounded-lg"
					style="background: url(./assets/images/banner/grocery-banner.png) no-repeat; background-size: cover; background-position: center">
					<div class="flex flex-col gap-5">
						<div class="flex flex-col gap-1">
							<h2 class="font-bold text-xl">Fruits & Vegetables</h2>
							<p>
								Get Upto
								<span class="font-bold text-gray-800">30%</span>
								Off
							</p>
						</div>

						<div class="flex flex-wrap">
							<a href="#!"
								class="btn inline-flex items-center gap-x-2 bg-gray-800 text-white border-gray-800 disabled:opacity-50 disabled:pointer-events-none hover:text-white hover:bg-gray-900 hover:border-gray-900 active:bg-gray-900 active:border-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300">
								Shop Now
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="w-full md:w-1/2">
				<div class="py-10 px-8 rounded-lg"
					style="background: url(./assets/images/banner/grocery-banner-2.jpg) no-repeat; background-size: cover; background-position: center">
					<div class="flex flex-col gap-5">
						<div class="flex flex-col gap-1">
							<h2 class="font-bold text-xl">Freshly Baked Buns</h2>
							<p>
								Get Upto
								<span class="font-bold text-gray-800">25%</span>
								Off
							</p>
						</div>

						<div class="flex flex-wrap">
							<a href="#!"
								class="btn inline-flex items-center gap-x-2 bg-gray-800 text-white border-gray-800 disabled:opacity-50 disabled:pointer-events-none hover:text-white hover:bg-gray-900 hover:border-gray-900 active:bg-gray-900 active:border-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300">
								Shop Now
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>