<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalles de la Cita') }}
            </h2>
            <a href="{{ route('cars.index') }}" class="btn btn-outline-primary px-2 py-1 rounded-md">
                {{ __('Volver') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 bg-white rounded-lg shadow-md">
                    @if($coche->getStatusCode() == '200')
                        @php
                            $lista_coche= $coche->getData();
                        @endphp
                    <ul class="space-y-6">
                        <li class="flex items-center">
                            <i class="bi bi-car-front-fill text-blue-500 me-2"></i>
                            <span class="font-medium text-gray-700">{{ __('Marca:') }}</span>
                            <span class="ms-2 text-gray-900">{{ $lista_coche->marca }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="bi bi-card-text text-green-500 me-2"></i>
                            <span class="font-medium text-gray-700">{{ __('Matricula:') }}</span>
                            <span class="ms-2 text-gray-900">{{ $lista_coche->matricula }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="bi bi-car-front text-red-500 me-2"></i>
                            <span class="font-medium text-gray-700">{{ __('Modelo:') }}</span>
                            <span class="ms-2 text-gray-900">{{ $lista_coche->modelo }}</span>
                        </li>
                    </ul>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>