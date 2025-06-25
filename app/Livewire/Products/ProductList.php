<?php

namespace App\Livewire\products;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\MsBarang;
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
  public function mount() {}



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
