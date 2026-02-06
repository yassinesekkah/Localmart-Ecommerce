@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Manage User Roles</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-gray-700 font-semibold">User</th>
                    <th class="px-4 py-2 text-left text-gray-700 font-semibold">Current Roles</th>
                    <th class="px-4 py-2 text-left text-gray-700 font-semibold">Update Roles</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @foreach($users as $user)
                <tr>
                    <td class="px-4 py-3">{{ $user->name }}</td>
                    <td class="px-4 py-3">
                        <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">
                            {{ $user->roles->pluck('name')->join(', ') ?: 'No Role' }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <form method="POST" action="{{ route('admin.roles.update', $user->id) }}" class="flex flex-rew gap-4">
                            @csrf
                            <div class="flex flex-wrap gap-2">
                                @foreach($roles as $role)
                                    <label class="flex items-center gap-1 bg-gray-50 px-2 py-1 rounded border hover:bg-gray-100 cursor-pointer">
                                        <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                            {{ $user->hasRole($role->name) ? 'checked' : '' }}
                                            class="form-checkbox h-4 w-4 text-blue-600">
                                        <span class="text-gray-700 text-sm">{{ $role->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <button type="submit"
                                class="mt-2 bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700 transition">
                                Update Roles
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $users->links() }}
    </div>
</div>
@endsection
