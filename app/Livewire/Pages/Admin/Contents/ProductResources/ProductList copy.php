<?php

namespace App\Livewire\Pages\Admin\Contents\ProductResources;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Mary\Traits\Toast;
use App\Livewire\Pages\Admin\Contents\ProductResources\Forms\ProductForm;


class ProductList extends Component
{

  public $title = "Products";
  public $url = "/products";

  public ProductForm $masterForm;


  public $text1 = "Text1";

  use WithPagination;

  public $productPaginators;

  public Collection $productsSearchable;
  public Collection $productsMultiSearchable;

  public  $product_searchable_id;
  public  $products_multi_searchable_ids;

  public $name = '';

  #[Locked]
  public $productId;

  #[Url]
  public ?string $search = '';

  public $cell_decoration;
  public $ProductsFilter;

  public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

  public $image_url = '';
  public $selling_price = null;
  public $price_max = null;
  public $is_activated = null;

  public function mount()
  {
    $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $this->cell_decoration = [];

    $this->search();
  }


  #[Computed]
  public function products(): LengthAwarePaginator
  {
    return Product::where('name', 'LIKE', "%{$this->search}%")->paginate(5);
  }

  #[Computed]
  public function headers(): array
  {
    return [
      ['key' => 'action', 'label' => 'Action', 'class' => 'border-r-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
      ['key' => 'id', 'label' => 'ID', 'class' => ' border-r-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
      ['key' => 'name', 'label' => 'Name', 'class' => ' border-r-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
      ['key' => 'image_url', 'label' => 'Image Url', 'class' => ' border-r-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
      ['key' => 'selling_price', 'label' => 'Selling Price', 'format' => ['currency', '2,.', 'Rp '], 'class' => ' border-r-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
      ['key' => 'is_activated', 'label' => 'Activate', 'class' => ' border-r-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
      ['key' => 'availability', 'label' => 'Availability', 'class' => ' border-r-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
      ['key' => 'created_at', 'label' => 'Date', 'format' => ['date', 'd/m/Y'], 'sortable' => true, 'class' => ' border-r-1 border-l-1 border-gray-300 dark:border-gray-600 text-center']
    ];
  }


  public function search(string $value = '')
  {
    $selectedOption = Product::where('id', $this->product_searchable_id)->get();

    $this->productsSearchable = Product::query()
      ->where('name', 'like', "%$value%")
      ->take(5)
      ->orderBy('name')
      ->get()
      ->merge($selectedOption);

    $this->productsMultiSearchable = Product::query()
      ->where('name', 'like', "%$value%")
      ->take(5)
      ->orderBy('name')
      ->get()
      ->merge($selectedOption);
  }

  public function advancedSearch()
  {
    $query = Product::query();

    if ($this->name) {
      $query->where('name', 'like', "%{$this->name}%");
    }

    if ($this->image_url) {
      $query->where('image_url', $this->image_url);
    }

    if ($this->selling_price !== null) {
      $query->where('selling_price', '>=', $this->selling_price);
    }

    if ($this->is_activated !== null) {
      $query->where('is_activated', '<=', $this->is_activated);
    }

    return $query->paginate(5);
  }


  public function clear(): void
  {
    $this->reset();
    $this->success('Filters cleared.', position: 'toast-bottom');
  }

  public function render()
  {
    return view('livewire.pages.admin.contents.product-resources.product-list')
      ->title($this->title);
  }
}
