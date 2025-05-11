<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Nuevo usuario') }}
            </h2>
            <a href="{{ route('users.index') }}" class="btn btn-outline-primary px-2 py-1 rounded-md">
                {{ __('Volver') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">{{ __('Nombre') }}</label>
                            <input type="text" name="name" id="name" class="w-full border-gray-300 rounded-md shadow-sm @error('name') border-red-500 @enderror" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700">{{ __('Email') }}</label>
                            <input type="email" name="email" id="email" class="w-full border-gray-300 rounded-md shadow-sm @error('email') border-red-500 @enderror" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700">{{ __('Contraseña') }}</label>
                            <input type="password" name="password" id="password" class="w-full border-gray-300 rounded-md shadow-sm @error('password') border-red-500 @enderror" required>
                            @error('password')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="role" class="block text-gray-700">{{ __('Rol') }}</label>
                            <select name="role" id="role" class="w-full border-gray-300 rounded-md shadow-sm @error('role') border-red-500 @enderror" required>
                                @foreach($roles as $value => $label)
                                    <option value="{{ $value }}" {{ old('role') == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-outline-primary px-4 py-2 rounded-md">
                            {{ __('Guardar') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>