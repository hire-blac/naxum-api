<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users View') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="container mx-auto p-4">
                    <h2 class="text-2xl font-bold mb-4">All Users</h2>

                    <a href="{{ route('admin.users.create') }}" class="mb-4 py-2 rounded mb-4 inline-block">
                      Create New User
                    </a>

                    <table class="w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2">#</th>
                                <th class="border px-4 py-2">Name</th>
                                <th class="border px-4 py-2">Email</th>
                                <th class="border px-4 py-2">Created At</th>
                                <th class="border px-4 py-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="border px-4 py-2">{{ $user->name }}</td>
                                    <td class="border px-4 py-2">{{ $user->email }}</td>
                                    <td class="border px-4 py-2">{{ $user->created_at->format('Y-m-d') }}</td>
                                    <td class="border px-4 py-2">
                                      <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-500">Edit</a>

                                      <form action="{{ route('admin.users.delete', $user) }}" method="POST" style="display:inline-block;">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" onclick="return confirm('Delete this user?')" class="text-red-600 ml-2">Delete</button>
                                      </form>
                                  </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>