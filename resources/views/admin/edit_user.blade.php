<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="container mx-auto max-w-xl p-4">
                <h2 class="text-2xl font-bold mb-4">Edit User</h2>

                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block mb-1">Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border p-2" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border p-2" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block mb-1">Password (leave blank to keep)</label>
                        <input type="password" name="password" class="w-full border p-2">
                    </div>

                    <button type="submit" class="px-4 py-2 rounded">Update User</button>
                </form>
            </div>

            </div>
        </div>
    </div>
</x-app-layout>