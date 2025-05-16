<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Mis Coches') }}
            </h2>
            <a href="{{ route('cars.create') }}" class="btn btn-outline-primary px-2 py-1 rounded-md">
                {{ __('Nuevo coche') }}
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

                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="table-fixed w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-4 py-2 w-1/6">{{ __('Marca') }}</th>
                                    <th class="border border-gray-300 px-4 py-2 w-1/3">{{ __('Matricula') }}</th>
                                    <th class="border border-gray-300 px-4 py-2 w-1/6">{{ __('Modelo') }}</th>
                                    <th class="border border-gray-300 px-4 py-2 w-1/6 text-center">{{ __('') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($coches != null && $coches->getStatusCode() == 200)
                                @foreach ($coches->getData() as $coche)
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2 w-1/3 truncate whitespace-nowrap">{{ $coche->marca }}</td>
                                        <td class="border border-gray-300 px-4 py-2 w-1/3 truncate whitespace-nowrap">{{ $coche->matricula }}</td>
                                        <td class="border border-gray-300 px-4 py-2 w-1/3 truncate whitespace-nowrap">{{ $coche->modelo }}</td>
                                        <td class="border border-gray-300 px-4 py-2 w-1/6 text-center"
                                            <div class="flex justify-center items-center gap-1">
                                                <a href="{{ route('cars.show', ['car' => $coche->id]) }}" class="btn btn-sm btn-outline-primary" title="{{ __('Ver') }}">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>
                                                <a href="{{ route('cars.edit', ['car' => $coche->id]) }}" class="btn btn-sm btn-outline-success" title="{{ __('Editar') }}">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                            
                                                <form action="{{ route('cars.destroy', ['car' => $coche->id]) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="{{ __('Eliminar') }}" onclick="return confirm('{{ __('¿Estás seguro?') }}')">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>