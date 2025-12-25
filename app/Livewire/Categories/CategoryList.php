<?php

namespace App\Livewire\Categories;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;

class CategoryList extends Component
{
    use WithPagination;

    public $name;
    public $categoryId;
    public $is_active = true;

    public $search = '';
    public $status = '';

    public $showForm = false;
    public $editing = false;
    public $confirmingDelete = false;

    // public $name, $categoryId, $is_active = true;

    protected $rules = [
        'name' => 'required|string|max:255'
    ];

    public function create()
    {
        $this->resetForm();
        $this->editing = false;
        $this->showForm = true;
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->is_active = $category->is_active;

        $this->editing = true;
        $this->showForm = true;
    }

    public function resetForm()
    {
        $this->reset(['name', 'categoryId', 'is_active']);
    }

    public function store()
    {
        $this->validate();

        Category::create([
            'name' => $this->name,
            'is_active' => true,
        ]);

        $this->resetForm();
        $this->showForm = false;

        session()->flash('message', 'Categoría creada correctamente.');
    }

    public function update()
    {
        $this->validate();

        $category = Category::findOrFail($this->categoryId);

        $category->update([
            'name' => $this->name,
            'is_active' => $this->is_active,
        ]);

        $this->resetForm();
        $this->showForm = false;
        $this->editing = false;

        session()->flash('message', 'Categoría actualizada correctamente.');
    }

    public function confirmDelete($id)
    {
        $this->categoryId = $id;
        $this->confirmingDelete = true;
    }

    public function deleteCategory()
    {
        Category::findOrFail($this->categoryId)->delete();

        $this->confirmingDelete = false;
        $this->categoryId = null;

        session()->flash('message', 'Categoría eliminada correctamente.');
    }

    public function mount()
    {
        if (request()->has('create')) {
            $this->resetForm();
            $this->editing = false;
            $this->showForm = true; // ✅ abre la modal
        }

         if (request()->has('edit')) {
            $id = request()->get('edit');
            $this->edit($id);
        }
    }

    public function render()
    {
        $categories = Category::query()
            ->when($this->search, fn($q)=>
                $q->where('name', 'like', '%' . $this->search . '%')
            )
            ->when($this->status !== '', fn($q)=>
                $q->where('is_active', $this->status === 'active')
            )
            ->paginate(10);

        return view('livewire.categories.category-list', [
            'categories' => $categories,
        ]);
    }
}
