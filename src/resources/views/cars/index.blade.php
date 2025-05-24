<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Coches') }}
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Contenedor para los coches -->
                    <div id="coches-contenedor">
                        <div class="spinner-grow text-primary" role="status">
                            <span class="visually-hidden">Cargando coches...</span>
                        </div>
                    </div>

                    <!-- Formulario para crear/actualizar coches -->
                    <div class="mt-6">
                        <div class="alert alert-success" role="alert" id="exito" style="display: none;">

                        </div>
                        <h3 class="text-lg font-semibold">Coches</h3>
                        <p>Selecciona un coche para ver los detalles.</p>
                        <form id="coche-form">
                            <input type="hidden" id="coche-id" name="id" value="">
                            <div class="mb-4">
                                <label for="marca" class="block text-sm font-medium text-gray-700">Marca</label>
                                <input type="text" id="marca" name="marca" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div class="mb-4">
                                <label for="modelo" class="block text-sm font-medium text-gray-700">Modelo</label>
                                <input type="text" id="modelo" name="modelo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div class="mb-4">
                                <label for="matricula" class="block text-sm font-medium text-gray-700">Matricula</label>
                                <input type="text" id="matricula" name="matricula" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <button type="submit" class="btn btn-outline-success px-4 py-2">Guardar</button>
                            <button type="button" id="limpiar-formulario" class="btn btn-outline-secondary px-4 py-2">Limpiar</button>
                        </form>
                        <div class="alert alert-danger" role="alert" id="error" style="display: none;">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Enlace al archivo JavaScript -->
    <script src="{{ asset('js/coches.js') }}"></script>
</x-app-layout>