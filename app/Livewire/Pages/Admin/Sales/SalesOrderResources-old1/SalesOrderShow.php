<?php

namespace App\Livewire\Pages\Admin\Sales\SalesOrderResources;

use App\Livewire\Pages\Admin\Sales\SalesOrderResources\Forms\SalesOrderForm;
use Livewire\Component;

class SalesOrderShow extends Component
{
  public function render()
  {
    return view('livewire.pages.admin.sales.sales-order-resources.sales-order-show')
      ->title($this->title);
  }

  use \Mary\Traits\Toast;

  #[\Livewire\Attributes\Locked]
  private string $basePageName = 'sales-order';

  #[\Livewire\Attributes\Locked]
  public string $title = 'Sales Order';

  #[\Livewire\Attributes\Locked]
  public string $url = '/sales-orders';


  #[\Livewire\Attributes\Locked]
  public string $id = '';

  #[\Livewire\Attributes\Locked]
  public string $readonly = '';

  #[\Livewire\Attributes\Locked]
  public bool $isReadonly = false;

  #[\Livewire\Attributes\Locked]
  public bool $isDisabled = false;

  #[\Livewire\Attributes\Locked]
  public array $options = [];

  #[\Livewire\Attributes\Locked]
  protected $masterModel = \App\Models\SalesOrder::class;

  public array $statuses = [];
  public array $processed = [];

  public SalesOrderForm $masterForm;

  public function mount()
  {
    $this->isReadonly = true;
    $this->isDisabled = true;
    $masterData = $this->masterModel::findOrFail($this->id);
    $this->masterForm->fill($masterData);
  }


  public function show() {}
}
