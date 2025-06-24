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

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProductList extends Component
{

  public string $title = "Product";
  public string $url = "/product";

  #[\Livewire\Attributes\Locked]
  public $id;

  use Toast;
  use WithPagination;

  #[Url(except: '')]
  public ?string $search = '';


  public function mount() {}

  public function render()
  {
    return view('livewire.product.product-list')
      ->title($this->title);
  }
}
