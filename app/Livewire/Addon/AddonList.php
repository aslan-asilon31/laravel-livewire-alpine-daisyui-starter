<?php

namespace App\Livewire\MsBarang;

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

class AddonList extends Component
{

  public string $title = "Addon";
  public string $url = "/addon";

  #[\Livewire\Attributes\Locked]
  public $id;

  use Toast;
  use WithPagination;

  #[Url(except: '')]
  public ?string $search = '';


  public function mount() {}

  public function render()
  {
    return view('livewire.addon.addon-list')
      ->title($this->title);
  }
}
