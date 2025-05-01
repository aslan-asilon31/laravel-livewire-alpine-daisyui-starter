<?php

namespace App\Livewire\Pages\Admin\Sales\SalesOrderDetailResources;

use App\Livewire\Pages\Admin\Sales\SalesOrderDetailResources\Forms\SalesOrderDetailForm;
use Livewire\Component;

class SalesOrderDetailShow extends Component
{
  public function render()
  {
    return view('livewire.pages.admin.sales.sales-order-resources.sales-order-detail-show')
      ->title($this->title);
  }

  use \Mary\Traits\Toast;

  #[\Livewire\Attributes\Locked]
  private string $basePageName = 'sales-order-detail';

  #[\Livewire\Attributes\Locked]
  public string $title = 'Sales Order Detail';

  #[\Livewire\Attributes\Locked]
  public string $url = '/sales-order-details';


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
