<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Editar cita') }}
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
                    <form action="{{ route('dates.update', $date) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="id_cliente" class="block text-gray-700">{{ __('Nombre del cliente') }}</label>
                            <select name="id_cliente" id="id_cliente" class="w-full border-gray-300 rounded-md shadow-sm @error('id_cliente') border-red-500 @enderror" required>
                                @foreach($users as $user)
                                @php
                                    $value= $user->id;
                                    $label= ucfirst($user->name);
                                @endphp
                                    <option value="{{ $value }}" {{ $date->id_cliente == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_cliente')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="marca" class="block text-gray-700">{{ __('Marca del coche: ') }}</label>
                            <input type="text" name="marca" id="marca" class="w-full border-gray-300 rounded-md shadow-sm @error('marca') border-red-500 @enderror" value="{{ $date->marca }}" required>
                            @error('marca')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="matricula" class="block text-gray-700">{{ __('Matricula del coche: ') }}</label>
                            <input type="text" name="matricula" id="matricula" class="w-full border-gray-300 rounded-md shadow-sm @error('matricula') border-red-500 @enderror" value="{{ $date->matricula }}" required>
                            @error('matricula')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="modelo" class="block text-gray-700">{{ __('Modelo del coche: ') }}</label>
                            <input type="text" name="modelo" id="modelo" class="w-full border-gray-300 rounded-md shadow-sm @error('modelo') border-red-500 @enderror" value="{{ $date->modelo }}" required>
                            @error('modelo')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="fecha" class="block text-gray-700">{{ __('Fecha de la cita: ') }}</label>
                            <input type="date" name="fecha" id="fecha" class="w-full border-gray-300 rounded-md shadow-sm @error('fecha') border-red-500 @enderror" value="{{ $date->fecha }}" >
                            @error('fecha')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="hora" class="block text-gray-700">{{ __('Hora de la cita: ') }}</label>
                            <input type="time" name="hora" id="hora" class="w-full border-gray-300 rounded-md shadow-sm @error('fecha') border-red-500 @enderror" value="{{ $date->hora }}" >
                            @error('hora')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="duracion" class="block text-gray-700">{{ __('Duración estimada de la cita (en minutos): ') }}</label>
                            <input type="number" name="duracion" id="duracion" class="w-full border-gray-300 rounded-md shadow-sm @error('duracion') border-red-500 @enderror" value="{{ $date->duracion }}">
                            @error('duracion')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-outline-primary px-4 py-2 rounded-md">
                            {{ __('Actualizar') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>