<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalles de la Cita') }}
            </h2>
            <a href="{{ route('mydates.index') }}" class="btn btn-outline-primary px-2 py-1 rounded-md">
                {{ __('Volver') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 bg-white rounded-lg shadow-md">
                    <ul class="space-y-6">
                        <li class="flex items-center">
                            <i class="bi bi-person-fill text-blue-500 me-2"></i>
                            <span class="font-medium text-gray-700">{{ __('Cliente:') }}</span>
                            <span class="ms-2 text-gray-900">{{ $date->cliente->name }}</span>
                        </li>
                        <li class="flex items-top">
                            <i class="bi bi-car-front-fill text-purple-500 me-2"></i>
                            <span class="font-medium text-gray-700">{{ __('Coche:') }}</span>
                            <ul class="mt-3">
                                <li>Marca: {{ $date->marca }},</li>
                                <li>Matrícula: {{ $date->matricula }},</li>
                                <li>Modelo: {{ $date->modelo }}.</li>
                            </ul>
                        </li>
                        <li class="flex items-center">
                            <i class="bi bi-clock-fill text-green-500 me-2"></i>
                            <span class="font-medium text-gray-700">{{ __('Fecha:') }}</span>
                            @if ($date->fecha != null || $date->hora != null)
                            <span class="ms-2 text-gray-900">{{ $date->fecha }} {{ $date->hora}}</span>
                            @else
                            <span class="ms-2 text-gray-900">Aún no establecida</span>
                            @endif
                        </li>
                        <li class="flex items-center">
                            <i class="bi bi-stopwatch text-black-500 me-2"></i>
                            <span class="font-medium text-gray-700">{{ __('Duración estimada:') }}</span>
                            @if ($date->fecha != null || $date->hora != null)
                            <span class="ms-2 text-gray-900">{{ $date->duracion }} minutos</span>
                            @else
                            <span class="ms-2 text-gray-900">Aún no establecida</span>
                            @endif
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>