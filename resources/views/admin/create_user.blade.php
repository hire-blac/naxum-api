<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
              <div class="container mx-auto p-4 max-w-lg">
                  <h2 class="text-2xl font-bold mb-4">Create New User</h2>

                  @if ($errors->any())
                      <div class="mb-4 text-red-500">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>- {{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif

                  <form action="{{ route('admin.users.store') }}" method="POST">
                      @csrf

                      <div class="mb-4">
                          <label for="name" class="block mb-1 font-semibold">Name</label>
                          <input type="text" name="name" id="name" class="w-full border p-2" required>
                      </div>

                      <div class="mb-4">
                          <label for="email" class="block mb-1 font-semibold">Email</label>
                          <input type="email" name="email" id="email" class="w-full border p-2" required>
                      </div>

                      <div class="mb-4">
                          <label for="password" class="block mb-1 font-semibold">Password</label>
                          <input type="password" name="password" id="password" class="w-full border p-2" required>
                      </div>

                      <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Create User</button>
                  </form>
              </div>
            </div>

        </div>
    </div>
</x-app-layout>
