@extends('layouts.admin')

@section('content')

<div class="w-full p-6 space-y-6">

    <!-- ================= USERS SECTION ================= -->
    @role('admin') <h2 class="text-lg font-semibold text-gray-700">Users Overview</h2>

    <div class="grid md:grid-cols-4 gap-6">

        <!-- Total Users -->
        <div class="bg-white shadow rounded-xl p-5 border">
            <p class="text-sm text-gray-500">Total Users</p>
            <h3 class="text-2xl font-bold mt-2">{{ $usersCount }}</h3>
        </div>

        <!-- Clients -->
        <div class="bg-blue-50 shadow rounded-xl p-5 border">
            <p class="text-sm text-gray-500">Clients</p>
            <h3 class="text-2xl font-bold mt-2 text-blue-600">
                {{ $totalClient}}
            </h3>
        </div>

        <!-- Sellers -->
        <div class="bg-green-50 shadow rounded-xl p-5 border">
            <p class="text-sm text-gray-500">Sellers</p>
            <h3 class="text-2xl font-bold mt-2 text-green-600">
                {{ $totalSellers }}
            </h3>
        </div>

        <!-- Admins -->
        <div class="bg-purple-50 shadow rounded-xl p-5 border">
            <p class="text-sm text-gray-500">Moderators</p>
            <h3 class="text-2xl font-bold mt-2 text-purple-600">
                {{ $totalModerator }}
            </h3>
        </div>

    </div>
    @endrole


    <!-- ================= PRODUCTS SECTION ================= -->
<h2 class="text-lg font-semibold text-gray-700 mt-8">Products Overview</h2>

<div class="grid md:grid-cols-3 gap-6">

    <!-- Total Products -->
    <div class="bg-white shadow rounded-xl p-5 border">
        <p class="text-sm text-gray-500">Total Products</p>
        <h3 class="text-2xl font-bold mt-2">{{ $productsCount }}</h3>
    </div>

    <!-- Total Categories -->
    <div class="bg-white shadow rounded-xl p-5 border">
        <p class="text-sm text-gray-500">Total Categories</p>
        <h3 class="text-2xl font-bold mt-2">{{ $categoryCount }}</h3>
    </div>

</div>



    <!-- ================= ORDERS SECTION ================= -->
    <h2 class="text-lg font-semibold text-gray-700 mt-8">Orders Overview</h2>

    <div class="grid md:grid-cols-4 gap-6">

        <div class="bg-white shadow rounded-xl p-5 border">
            <p class="text-sm text-gray-500">Total Orders</p>
            <h3 class="text-2xl font-bold mt-2">{{ $ordersCount }}</h3>
        </div>

        <div class="bg-yellow-50 shadow rounded-xl p-5 border">
            <p class="text-sm text-gray-500">Pending</p>
            <h3 class="text-2xl font-bold mt-2 text-yellow-600">
                {{ $pendings }}
            </h3>
        </div>

        <div class="bg-blue-50 shadow rounded-xl p-5 border">
            <p class="text-sm text-gray-500">Paid</p>
            <h3 class="text-2xl font-bold mt-2 text-blue-600">
                {{ $paids }}
            </h3>
        </div>

        <div class="bg-green-50 shadow rounded-xl p-5 border">
            <p class="text-sm text-gray-500">Delivered</p>
            <h3 class="text-2xl font-bold mt-2 text-green-600">
                {{ $delivered }}
            </h3>
        </div>



    </div>
 <div class="bg-white p-6 rounded-xl shadow w-64">
    <h2 class="text-lg font-semibold mb-4">Orders by Status</h2>

    <div class="h-64">  
        <canvas id="ordersChart"></canvas>
    </div>
</div>


    <!-- ================= REVENUE SECTION ================= -->
    <h2 class="text-lg font-semibold text-gray-700 mt-8">Revenue</h2>

    <div class="grid md:grid-cols-2 gap-6">

        <div class="bg-emerald-50 shadow rounded-xl p-6 border">
            <p class="text-sm text-gray-500">Total Revenue</p>
            <h3 class="text-3xl font-bold mt-3 text-emerald-600">
            {{ $revenue }} DH
            </h3>
        </div>

        <div class="bg-gray-50 shadow rounded-xl p-6 border">
            <p class="text-sm text-gray-500">Total Likes</p>
            <h3 class="text-2xl font-bold mt-3">
                {{ $likesCount}}
            </h3>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
const ctx = document.getElementById('ordersChart');

new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Pending', 'Paid', 'Delivered'],
        datasets: [{
            label: 'Commandes',
            data: @json([$pendings ?? 0, $paids ?? 0, $delivered ?? 0]),
            borderWidth: 1
        }]
    }
});
</script>


@endsection
