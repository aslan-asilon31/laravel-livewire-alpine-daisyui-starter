<?php

namespace App\Livewire\Pages\Admin\Sales\SalesOrderResources;

use App\Livewire\Pages\Admin\Sales\SalesOrderResources\Forms\SalesOrderForm;
use Livewire\Component;
use App\Models\SalesOrder;

class SalesOrderDetailCreate extends Component
{
  public function render()
  {
    return view('livewire.pages.admin.sales.sales-order-resources.sales-order-detail-create')
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
  private string $baseImageName = 'sales_order_image';

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

  public function mount() {}

  public function initialize()
  {

    // $masterData = $this->masterModel::with([
    //   'customer',
    // ])
    //   ->findOrFail($this->id)
    //   ->toArray();
  }

  public function create()
  {

    $this->masterForm->reset();
  }

  public function store()
  {

    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $this->isReadonly = true;


    \Illuminate\Support\Facades\DB::beginTransaction();
    try {

      $validatedForm['created_by'] = 'admin';
      $validatedForm['updated_by'] = 'admin';

      $this->masterModel::create($validatedForm);
      \Illuminate\Support\Facades\DB::commit();

      $this->create();
      $this->success('Data has been stored');
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      \Log::error('Data failed to store: ' . $th->getMessage());
      $this->error('Data failed to store');
    }
  }
}
