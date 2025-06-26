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
  public $count = 5;

  #[\Livewire\Attributes\Locked]
  public $id;

  use Toast;
  use WithPagination;

  #[Url(except: '')]
  public ?string $search = '';

  public array $products = [];
  public $products1 = [];
  public $allProducts2 = [];
  public array $productsSend = [];
  public array $productsSend1 = [];
  public array $productsSend2 = [];


  public bool $filterDrawer;

  public array $sortBy = ['column' => 'title', 'direction' => 'desc'];

  #[Url(except: '')]
  public array $filters = [];
  public array $filterForm = [
    'title' => '',
    'description' => '',
    'category' => '',

  ];


  public function mount() {}




  #[Computed]
  public function headers(): array
  {
    return [
      ['key' => 'id', 'label' => 'ID', 'sortBy' => 'id', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'title', 'label' => 'title', 'sortBy' => 'title', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'description', 'label' => '#', 'sortable' => false, 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'category', 'label' => 'category',  'sortBy' => 'category', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
    ];
  }

  #[Computed]
  public function rows(): LengthAwarePaginator
  {
    $collection = collect($this->productsSend);

    // Filter manual
    $filtered = $collection->filter(function ($item) {
      $match = true;

      if ($this->search) {
        $match = $match && str_contains(strtolower($item['title'] ?? ''), strtolower($this->search));
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

    // Manual pagination
    $perPage = 20;
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
        'filterForm.description' => 'nullable|string',
        'filterForm.category' => 'nullable|string',
      ],
      [],
      [
        'filterForm.title' => 'title',
        'filterForm.description' => 'description',
        'filterForm.category' => 'category',
      ]
    )['filterForm'];

    $this->filters = collect($validatedFilters)->reject(fn($value) => $value === '')->toArray();
    $this->success('Filter Result');
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

  #[On('send-to-livewire1')]
  public function updatedData1($products)
  {
    $this->productsSend1 = $products;
  }

  #[On('send-to-livewire2')]
  public function updatedData2($payload)
  {
    $products = json_decode(json_encode($payload), true);
    $this->productsSend2 = $products;
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
    dd('atop1');
    $this->count++;
  }

  public function decrement()
  {
    $this->count--;
  }

  public function count()
  {
    dd('stop count');
  }

  // #[On('send-to-livewire')]
  // public function receiveProductsFromAlpine($products)
  // {
  public function receiveProductsFromAlpine()
  {
    // if (empty($products)) {
    //   // Log atau debug lebih lanjut untuk mencari penyebabnya
    //   \Log::debug('Produk kosong atau tidak sesuai');



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


  // public function exportExcel()
  // {
  //   $filename = 'products_' . now()->format('Y-m-d_H-i-s') . '.xlsx';

  //   return Excel::download(new ProductsExport($this->products), $filename);
  // }

  public function receiveProducts($data)
  {
    $this->products1 = $data;
  }


  public function showData()
  {
    dd('hello');
    // dd($this->products);
  }


  public function render()
  {
    return view('livewire.product.product-list')
      ->title($this->title);
  }
}
