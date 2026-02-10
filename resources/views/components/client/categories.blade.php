@props(['categories'])


<!-- Featured Categories -->
<section class="mt-12">
	<div class="container mx-auto px-4">
		<h2 class="text-2xl font-bold mb-6">Featured Categories</h2>
		<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
			<!-- static table img for test only -->


			<!-- Category Cards -->
			@php
			$colors = ['bg-green-300', 'bg-red-300', 'bg-blue-400', 'bg-yellow-300', 'bg-green-600'];
			@endphp

			@foreach ($categories as $index => $category)
			<a href="{{ route('client.categorieProducts', $category->id) }}" class="group">
				<div class="{{ $colors[$index % count($colors)] }} border border-gray-300 rounded-lg p-6 text-center hover:border-green-600 hover:shadow-md transition duration-300">
					<span class="">
						{{ $category->description }}
					</span>
				</div>
			</a>
			@endforeach

		</div>
	</div>
</section>



<!-- Banner Section -->
<section class="mt-20">
	<div class="container mx-auto px-4">
		<div class="grid md:grid-cols-2 gap-6">
			<div class="rounded-lg p-10 bg-gradient-to-br from-green-400 to-green-600 text-white">
				<h2 class="text-2xl font-bold mb-2">Fruits & Vegetables</h2>
				<p class="mb-6">
					Get Upto <span class="font-bold text-yellow-300">30%</span> Off
				</p>
				<a href="#" class="inline-block px-6 py-3 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition">
					Shop Now
				</a>
			</div>
			<div class="rounded-lg p-10 bg-gradient-to-br from-orange-400 to-red-500 text-white">
				<h2 class="text-2xl font-bold mb-2">Freshly Baked Buns</h2>
				<p class="mb-6">
					Get Upto <span class="font-bold text-yellow-300">25%</span> Off
				</p>
				<a href="#" class="inline-block px-6 py-3 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition">
					Shop Now
				</a>
			</div>
		</div>
	</div>
</section>