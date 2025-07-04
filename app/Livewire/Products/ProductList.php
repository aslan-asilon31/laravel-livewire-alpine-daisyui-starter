<?php

namespace App\Livewire\products;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Feature;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Mary\Traits\Toast;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;

class ProductList extends Component
{

  public string $title = "Product";
  public string $url = "/product";
  public string $content = '';
  public array $data = [];

  #[\Livewire\Attributes\Locked]
  public $id;

  use Toast;
  use WithPagination;

  #[Url(except: '')]
  public ?string $search = '';

  public array $products = [];
  public array $productsSend = [];

  public bool $filterDrawer = false;

  public array $sortBy = ['column' => 'title', 'direction' => 'desc'];


  #[Url(except: '')]
  public $filters = [
    'images' => '',
    'title' => '',
    'availabilityStatus' => '',
    'category' => '',
  ];

  public array $filterForm = [
    'title' => '',
    'availabilityStatus' => '',
    'brand' => '',
    'category' => '',
    'description' => '',
    'dimensions.depth' => '',
    'dimensions.height' => '',
    'dimensions.width' => '',
    'discountPercentage' => '',
  ];

  public function mount() {}

  public function openDrawer()
  {
    $this->filterDrawer = true;
  }


  #[Computed]
  public function headers(): array
  {

    return [
      ['key' => 'action', 'label' => 'Action', 'sortable' => false, 'class' => 'whitespace-nowrap border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
      ['key' => 'id', 'label' => 'ID', 'sortBy' => 'id', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'title', 'label' => 'title', 'sortBy' => 'title', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'availabilityStatus', 'label' => 'availabilityStatus', 'sortBy' => 'availabilityStatus', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'category', 'label' => 'category',  'sortBy' => 'category', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
      ['key' => 'dimensions.depth', 'label' => 'dimensions.depth', 'sortable' => false, 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'dimensions.height', 'label' => 'dimensions.height', 'sortable' => false, 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'dimensions.width', 'label' => 'dimensions.width', 'sortable' => false, 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'discountPercentage', 'label' => 'discountPercentage', 'sortable' => false, 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'description', 'label' => 'Description', 'sortable' => false, 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
    ];
  }

  #[Computed]
  public function rows(): LengthAwarePaginator
  {
    $collection = collect($this->productsSend);

    $filtered = $collection->filter(function ($item) {
      $match = true;


      if ($this->search) {
        $match = $match && str_contains(strtolower($item['title'] ?? ''), strtolower($this->search));
      }

      if (!empty($this->filters['id'])) {
        $match = $match && str_contains(strtolower($item['id'] ?? ''), strtolower($this->filters['id']));
      }

      if (!empty($this->filters['title'])) {
        $match = $match && str_contains(strtolower($item['title'] ?? ''), strtolower($this->filters['title']));
      }


      if (!empty($this->filters['description'])) {
        $match = $match && str_contains(strtolower($item['description'] ?? ''), strtolower($this->filters['description']));
      }

      if (!empty($this->filters['category'])) {
        $match = $match && str_contains(strtolower($item['category'] ?? ''), strtolower($this->filters['category']));
      }

      return $match;
    });

    $perPage = 10;
    $page = request()->get('page', 1);
    $items = $filtered->slice(($page - 1) * $perPage, $perPage)->values();
    $paginator = new LengthAwarePaginator(
      $items,
      $filtered->count(),
      $perPage,
      $page,
      ['path' => request()->url(), 'query' => request()->query()]
    );

    return $paginator;
  }


  public function filter()
  {
    $validatedFilters = $this->validate(
      [
        'filterForm.title' => 'nullable|string',
        'filterForm.availabilityStatus' => 'nullable|string',
        'filterForm.brand' => 'nullable|string',
        'filterForm.category' => 'nullable|string',
        'filterForm.description' => 'nullable|string',
        'filterForm.dimensions.depth' => 'nullable|string',
        'filterForm.dimensions.height' => 'nullable|string',
        'filterForm.dimensions.width' => 'nullable|string',
        'filterForm.discountPercentage' => 'nullable|string',
      ],
      [],
      [
        'filterForm.title' => 'title',
        'filterForm.availabilityStatus' => 'availability Status',
        'filterForm.brand' => 'Brand',
        'filterForm.description' => 'description',
        'filterForm.category' => 'category',
        'filterForm.dimensions.depth' => 'dimensions depth',
        'filterForm.dimensions.height' => 'dimensions height',
        'filterForm.dimensions.width' => 'dimensions width',
        'filterForm.discountPercentage' => 'discount Percentage',
      ]
    )['filterForm'];

    $this->filters = collect($validatedFilters)->reject(fn($value) => $value === '')->toArray();
    $this->success('Filter Result');
  }

  public function filter1()
  {
    $this->validate([
      'filters.images' => 'nullable',
      'filters.title' => 'nullable|string',
      'filters.availabilityStatus' => 'nullable|string',
      'filters.category' => 'nullable|string',
    ]);

    $collection = collect($this->productsSend);

    if ($this->filters['title']) {
      $collection = $collection->filter(fn($product) => str_contains(strtolower($product['title']), strtolower($this->filters['title'])));
    }
    if ($this->filters['availabilityStatus']) {
      $collection = $collection->filter(fn($product) => str_contains(strtolower($product['availabilityStatus']), strtolower($this->filters['availabilityStatus'])));
    }
    if ($this->filters['category']) {
      $collection = $collection->filter(fn($product) => str_contains(strtolower($product['category']), strtolower($this->filters['category'])));
    }

    $this->productsSend = $collection->values()->all();

    $this->filterDrawer = false;
  }


  public function clear(): void
  {
    $this->reset('filters');
    $this->reset('filterForm');
    $this->success('filter cleared');
  }

  #[On('send-to-livewire')]
  public function updatedData(array $products)
  {
    $this->productsSend = $products;
  }


  public function storeProducts()
  {
    dd('mo simpan', $this->productsSend);
    foreach ($this->productsSend as $product) {
      // Simpan ke DB (gunakan only kolom yang ada di database!)
      Feature::updateOrCreate(
        ['external_id' => $product['id']], // gunakan kolom unik jika ada
        [
          'title' => $product['title'] ?? '',
          'description' => $product['description'] ?? '',
          'price' => $product['price'] ?? 0,
        ]
      );
    }

    session()->flash('message', 'Produk berhasil disimpan!');
  }


  public function increment()
  {
    $this->count++;
  }

  public function decrement()
  {
    $this->count--;
  }


  public function save()
  {
    dd('stopppp1');
  }

  public function showLivewireCount()
  {
    session()->flash('message', 'Livewire knows the count is: ' . $this->count);
  }

  public function tesTampil()
  {
    return 12;
  }


  public function render()
  {
    return view('livewire.product.product-list')
      ->title($this->title);
  }
}
