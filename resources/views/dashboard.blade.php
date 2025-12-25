<x-layouts.app :title="__('Dashboard')">

    <div class="space-y-6">

        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Panel de Inventario</h1>
        <p class="text-gray-600 dark:text-gray-300">Acceso rápido a gestión de categorías y productos</p>

        {{-- CARDS PRINCIPALES --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- CATEGORÍAS --}}
            <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-xl space-y-3 flex flex-col">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-semibold text-gray-900 dark:text-white">Categorías</span>
                    <flux:icon name="folder-git-2" class="w-5 h-5 text-gray-500"/>
                </div>

                <div class="text-3xl font-bold text-gray-900 dark:text-white">
                    {{ \App\Models\Category::count() }}
                </div>

                <flux:button icon="home" class="w-full mt-auto" :href="route('categories.index')" wire:navigate>
                    Ver Categorías
                </flux:button>
            </div>  

            {{-- PRODUCTOS --}}
            <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-xl space-y-3 flex flex-col">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-semibold text-gray-900 dark:text-white">Productos</span>
                    <flux:icon name="book-open-text" class="w-5 h-5 text-gray-500"/>
                </div>

                <div class="text-3xl font-bold text-gray-900 dark:text-white">
                    {{ \App\Models\Product::count() }}
                </div>

                <flux:button icon="home" class="w-full mt-auto" :href="route('products.index')" wire:navigate>
                    Ver Productos
                </flux:button>
            </div>

            {{-- ACCIONES RÁPIDAS --}}
            <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-xl space-y-3 flex flex-col">
                <div class="flex justify-between items-center mb-10">
                    <span class="text-lg font-semibold text-gray-900 dark:text-white">
                        Acciones rápidas
                    </span>
                    <flux:icon name="cog" class="w-5 h-5 text-gray-500"/>
                </div>

                <div class="space-y-2 mt-auto">
                    <flux:button
                        icon="home"
                        variant="outline"
                        class="w-full"
                        :href="route('categories.index', ['create' => 1])"
                        wire:navigate>
                        Nueva Categoría
                    </flux:button>

                    <flux:button
                        icon="home"
                        variant="outline"
                        class="w-full"
                        :href="route('products.index', ['create' => 1])"
                        wire:navigate>
                        Nuevo Producto
                    </flux:button>
                </div>
            </div>
        </div>

        {{-- ✅ Últimos registros --}}
        @php
            $lastCategory = \App\Models\Category::latest()->first();
            $lastProduct = \App\Models\Product::latest()->with('category')->first();
        @endphp

        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Últimos registros</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Última Categoría --}}
            @if($lastCategory)
            <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-xl space-y-3 flex flex-col">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-semibold uppercase underline">Categoría</span>
                    <flux:icon name="home" class="w-5 h-5"/>
                </div>
                <p class="font-semibold">{{ $lastCategory->name }}</p>
                
                <span class="text-sm text-gray-600 dark:text-gray-400">
                    Estado:
                    @if($lastCategory->is_active)
                        <span class="text-green-500 font-semibold">Activo</span>
                    @else
                        <span class="text-yellow-500 font-semibold">Inactivo</span>
                    @endif
                </span>
                <flux:button class="w-full mt-2 mt-auto" variant="outline"
                    :href="route('categories.index',['edit' => $lastCategory->id])"
                    wire:navigate>
                    Editar Categoría
                </flux:button>
            </div>
            @endif

            {{-- Último Producto --}}
            @if($lastProduct)
            <div class="p-6 bg-white dark:bg-gray-800 shadow rounded-xl space-y-3 flex flex-col">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-semibold uppercase underline">Producto</span>
                    <flux:icon name="home" class="w-5 h-5"/>
                </div>
                <p class="font-semibold">{{ $lastProduct->name }}</p>

                <div class="text-sm text-gray-600 dark:text-gray-400">
                    <p>Categoría: <strong>{{ $lastProduct->category?->name ?? '-' }}</strong></p>
                    <p>Precio: <strong>{{ $lastProduct->formatted_price }}</strong></p>
                    <p>Stock: <strong>{{ $lastProduct->stock }}</strong></p>
                    <p>Estado:
                        @if($lastProduct->is_active)
                            <span class="text-green-500 font-semibold">Activo</span>
                        @else
                            <span class="text-yellow-500 font-semibold">Inactivo</span>
                        @endif
                    </p>
                </div>
                <flux:button class="w-full mt-2 mt-auto" variant="outline"
                    :href="route('products.index',['edit' => $lastProduct->id])"
                    wire:navigate>
                    Editar Producto
                </flux:button>
            </div>
            @endif

        </div>
    </div>

</x-layouts.app>
