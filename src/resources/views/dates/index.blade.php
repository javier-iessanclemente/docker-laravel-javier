<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Citas') }}
            </h2>
            <a href="{{ route('dates.create') }}" class="btn btn-outline-primary px-2 py-1 rounded-md">
                {{ __('Nueva cita') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="table-fixed w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-4 py-2 w-1/3">{{ __('Cliente') }}</th>
                                    <th class="border border-gray-300 px-4 py-2 w-1/6">{{ __('Coche') }}</th>
                                    <th class="border border-gray-300 px-4 py-2 w-1/3">{{ __('Fecha') }}</th>
                                    <th class="border border-gray-300 px-4 py-2 w-1/6">{{ __('Hora') }}</th>
                                    <th class="border border-gray-300 px-4 py-2 w-1/6">{{ __('Duracion estimada (minutos)') }}</th>
                                    <th class="border border-gray-300 px-4 py-2 w-1/6 text-center">{{ __('') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dates as $date)
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2 w-1/3 truncate whitespace-nowrap">{{ $date->cliente->name }}</td>
                                        <td class="border border-gray-300 px-4 py-2 w-1/3 truncate whitespace-nowrap">Marca: {{ $date->marca }}<br>Matrícula: {{ $date->matricula }}<br>Modelo: {{ $date->modelo }}</td>
                                        @php
                                            $hora = new Datetime($date->hora);
                                        @endphp
                                        <td class="border border-gray-300 px-4 py-2 w-1/3 truncate whitespace-nowrap">{{ $date->fecha }}</td>
                                        <td class="border border-gray-300 px-4 py-2 w-1/3 truncate whitespace-nowrap">{{ $hora->format('H:i') }}</td>
                                        @if($date->duracion != null)
                                        <td class="border border-gray-300 px-4 py-2 w-1/3 truncate whitespace-nowrap">{{ $date->duracion }} minutos</td>
                                        @else 
                                        <td class="border border-gray-300 px-4 py-2 w-1/3 truncate whitespace-nowrap">{{ $date->duracion }}</td>
                                        @endif
                                        <td class="border border-gray-300 px-4 py-2 w-1/6 text-center"
                                            <div class="flex justify-center items-center gap-1">
                                                <a href="{{ route('dates.show', $date) }}" class="btn btn-sm btn-outline-primary" title="{{ __('Ver') }}">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>

                                                <a href="{{ route('dates.edit', $date) }}" class="btn btn-sm btn-outline-success" title="{{ __('Editar') }}">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>

                                                <form action="{{ route('dates.destroy', $date) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                            title="{{ __('Eliminar') }}"
                                                            onclick="return confirm('{{ __('¿Estás seguro?') }}')">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>