<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Nuevo coche') }}
            </h2>
            <a href="{{ route('cars.index') }}" class="btn btn-outline-primary px-2 py-1 rounded-md">
                {{ __('Volver') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <form action="{{ route('cars.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="marca" class="block text-gray-700">{{ __('Marca del coche: ') }}</label>
                            <input type="text" name="marca" id="marca" class="w-full border-gray-300 rounded-md shadow-sm @error('marca') border-red-500 @enderror" value="{{ old('marca') }}" required>
                            @error('marca')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="matricula" class="block text-gray-700">{{ __('Matricula del coche: ') }}</label>
                            <input type="text" name="matricula" id="matricula" class="w-full border-gray-300 rounded-md shadow-sm @error('matricula') border-red-500 @enderror" value="{{ old('matricula') }}" required>
                            @error('matricula')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="modelo" class="block text-gray-700">{{ __('Modelo del coche: ') }}</label>
                            <input type="text" name="modelo" id="modelo" class="w-full border-gray-300 rounded-md shadow-sm @error('modelo') border-red-500 @enderror" value="{{ old('modelo') }}" required>
                            @error('modelo')
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