<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalles del usuario') }}
            </h2>
            <a href="{{ route('users.index') }}" class="btn btn-outline-primary px-2 py-1 rounded-md">
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
                            <span class="font-medium text-gray-700">{{ __('Nombre:') }}</span>
                            <span class="ms-2 text-gray-900">{{ $user->name }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="bi bi-envelope-fill text-green-500 me-2"></i>
                            <span class="font-medium text-gray-700">{{ __('Email:') }}</span>
                            <span class="ms-2 text-gray-900"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></span>
                        </li>
                        <li class="flex items-center">
                            <i class="bi bi-person-badge-fill text-purple-500 me-2"></i>
                            <span class="font-medium text-gray-700">{{ __('Rol:') }}</span>
                            <span class="ms-2 text-gray-900">{{ $roles[$user->role] }}</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>