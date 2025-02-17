@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-semibold mb-6">Panel de SuperAdmin</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Gestión de Sitios -->
                    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                        <h2 class="text-xl font-semibold mb-4">Gestión de Sitios</h2>
                        <p class="text-gray-600 mb-4">Administra los sitios y sus configuraciones.</p>
                        <a href="{{ route('superadmin.sites.index') }}" 
                           class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Ver Sitios
                        </a>
                    </div>

                    <!-- Gestión de Usuarios -->
                    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                        <h2 class="text-xl font-semibold mb-4">Gestión de Usuarios</h2>
                        <p class="text-gray-600 mb-4">Administra los usuarios y sus permisos.</p>
                        <a href="{{ route('superadmin.users.index') }}" 
                           class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Ver Usuarios
                        </a>
                    </div>

                    <!-- Gestión de Contenido -->
                    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                        <h2 class="text-xl font-semibold mb-4">Gestión de Contenido</h2>
                        <p class="text-gray-600 mb-4">Administra el contenido global del sistema.</p>
                        <div class="space-y-2">
                            <a href="{{ route('superadmin.content.pages.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Páginas
                            </a>
                            <a href="{{ route('superadmin.content.news.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Noticias
                            </a>
                            <a href="{{ route('superadmin.content.people.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Personas
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Resumen de Sitios -->
                <div class="mt-8">
                    <h2 class="text-xl font-semibold mb-4">Sitios Activos</h2>
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dominio</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($sites as $site)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $site->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $site->domain }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Activo
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('superadmin.sites.edit', $site) }}" class="text-primary-600 hover:text-primary-900">Editar</a>
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
</div>
@endsection
