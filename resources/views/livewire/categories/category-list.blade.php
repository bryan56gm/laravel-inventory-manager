<div class="p-6">

    {{-- Flash Message --}}
    @if (session('message'))
        <div 
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 4000)"
            class="fixed top-0 left-0 right-0 bg-green-600 text-white px-4 py-2 shadow text-center z-50"
        >
            {{ session('message') }}
        </div>
    @endif

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Categorías</h1>

        <flux:button wire:click="create" class="cursor-pointer">
            + Nueva Categoría
        </flux:button>
    </div>

    {{-- Modal Form --}}
    <flux:modal wire:model="showForm">
        <flux:heading level="2" class="mb-4 uppercase">
            {{ $editing ? 'Editar Categoría' : 'Crear Categoría' }}
        </flux:heading>

        <form wire:submit.prevent="{{ $editing ? 'update' : 'store' }}" class="space-y-4">
            <flux:input 
                label="Nombre de la categoría" 
                wire:model="name"
                placeholder="Ej. Electrónica"
            />
            
            {{-- Mostrar estado solo al editar --}}
            @if ($editing)
                <flux:select label="Estado" wire:model="is_active" class="cursor-pointer">
                    <option value="">Selecciona Estado</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </flux:select>
            @endif

            <div class="flex justify-end gap-2 pt-2">
                <flux:button wire:click="$set('showForm', false)" class="cursor-pointer">
                    Cancelar
                </flux:button>

                <flux:button type="submit" variant="primary" class="cursor-pointer">
                    {{ $editing ? 'Actualizar' : 'Guardar' }}
                </flux:button>
            </div>
        </form>
    </flux:modal>

    {{-- Modal Delete --}}
    <flux:modal wire:model="confirmingDelete">
        <flux:heading level="2" class="mb-4 uppercase">
            Confirmar eliminación
        </flux:heading>

        <p class="mb-6">
            ¿Seguro que deseas eliminar esta categoría?
        </p>

        <div class="flex justify-end gap-2 pt-2">
            <flux:button wire:click="$set('confirmingDelete', false)" class="cursor-pointer">
                Cancelar
            </flux:button>

            <flux:button variant="danger" wire:click="deleteCategory" class="cursor-pointer">
                Eliminar
            </flux:button>
        </div>
    </flux:modal>

    {{-- Filters --}}
    <div class="flex flex-wrap md:flex-nowrap gap-3 mb-4 ">
        <flux:input 
            wire:model.live.debounce.300ms="search"
            placeholder="Buscar categoría..."
            class="w-full md:max-w-xs"
        />

        <flux:select wire:model.live="status" class="w-full md:max-w-xs cursor-pointer">
            <option value="">Todos los estados</option>
            <option value="active">Activas</option>
            <option value="inactive">Inactivas</option>
        </flux:select>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto bg-white shadow rounded">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-200 font-bold uppercase">
            <tr>
                <th class="px-4 py-3 text-left text-gray-700">Nombre</th>
                <th class="px-4 py-3 text-left text-gray-700">Estado</th>
                <th class="px-4 py-3 text-right text-gray-700">Acciones</th>
            </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-100">
            @forelse($categories as $category)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-gray-900">
                        {{ $category->name }}
                    </td>

                    <td class="px-4 py-3">
                        @if ($category->is_active)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Activa
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Inactiva
                            </span>
                        @endif
                    </td>

                    <td class="px-4 py-3 text-right">
                        <div class="inline-flex items-center gap-2">
                            <flux:button size="xs" wire:click="edit({{ $category->id }})" class="!px-2 !py-1 cursor-pointer">
                                Editar
                            </flux:button>

                            <flux:button size="xs" variant="danger" wire:click="confirmDelete({{ $category->id }})" class="!px-2 !py-1 cursor-pointer">
                                Eliminar
                            </flux:button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-4 py-6 text-center text-gray-500">
                        No hay categorías
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $categories->links() }}
    </div>
</div>
