<?php

namespace App\Livewire\Products;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;

class ProductList extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $status = '';
    public $is_active = true;


    public $showForm = false;
    public $name, $price, $stock, $category_id;

    public $editing = false;
    public $productId;

    public $confirmingDelete = false;
    public $deleteId = null;

    public $openCreateModal = false;



    // Mantener filtros en la URL
    protected $updatesQueryString = ['search','category','status','page'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $this->productId = $product->id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->category_id = $product->category_id;

        $this->is_active = $product->is_active;
        $this->editing = true;
        $this->showForm = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:5',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::where('id', $this->productId)->update([
            'name' => $this->name,
            'price' => $this->price,
            'stock' => $this->stock,
            'category_id' => $this->category_id,
            'is_active' => $this->is_active,
        ]);

        $this->showForm = false;
        $this->editing = false;

        session()->flash('message', 'Producto actualizado correctamente ✅');
    }

    public function create()
    {
        $this->is_active = true;
        $this->resetForm();
        $this->showForm = true;
    }

    public function resetForm()
    {
        $this->name = '';
        $this->price = '';
        $this->stock = '';
        $this->category_id = '';
        $this->editing = false;
        $this->productId = null;
        $this->is_active = true;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:5|max:500',
            'stock' => 'required|integer|min:0|max:100',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create([
            'name' => $this->name,
            'price' => $this->price,
            'stock' => $this->stock,
            'category_id' => $this->category_id,
            'is_active' => true,
        ]);

        $this->showForm = false;
        $this->resetPage();
        $this->dispatch('refreshProducts');

        session()->flash('message', 'Producto creado correctamente ✅');
    }

    public function deleteProduct()
    {
        Product::findOrFail($this->deleteId)->delete();

        $this->confirmingDelete = false;
        $this->deleteId = null;

        session()->flash('message', 'Producto eliminado correctamente ✅');
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    public function mount()
    {
        if (request()->has('create')) {
            $this->resetForm();
            $this->editing = false;
            $this->showForm = true; 
        }

         if (request()->has('edit')) {
            $id = request()->get('edit');
            $this->edit($id);
        }
    }

    public function render()
    {
        $products = Product::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->when($this->category, fn($q) => $q->where('category_id', $this->category))
            ->when($this->status !== '', fn($q) => 
                $q->where('is_active', $this->status === 'active')
            )
            ->latest()
            ->paginate(10);

        $categories = Category::where('is_active', true)->get();

        return view('livewire.products.product-list', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
