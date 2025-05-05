<?php

namespace App\Livewire\Pages\Admin\Sales\SalesOrderResources;

use App\Livewire\Pages\Admin\Sales\SalesOrderResources\Forms\SalesOrderForm;
use App\Livewire\Pages\Admin\Sales\SalesOrderResources\Forms\SalesOrderDetailForm;
use Livewire\Component;
use App\Models\SalesOrder;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\SalesOrderDetail;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;

class SalesOrderCreate extends Component
{
  public function render()
  {
    return view('livewire.pages.admin.sales.sales-order-resources.sales-order-create')
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
  protected $headerModel = \App\Models\SalesOrder::class;
  protected $detailModel = \App\Models\SalesOrderDetail::class;

  public array $validatedForm = [];
  public array $validatedFormDetail = [];
  public bool $modalDetail = false;
  public array $details = [];
  public  $detailId = null;
  public array $headers = [];

  public SalesOrderForm $masterForm;
  public SalesOrderDetailForm $masterFormDetail;

  public function mount() {}

  public function initialize() {}

  public function create()
  {
    $this->masterForm->reset();
    $this->masterFormDetail->reset();
  }

  public function store()
  {
    $this->validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    try {
      $this->validatedForm['id'] = (string) Str::uuid();
      $this->validatedFormDetail['id'] = (string) Str::uuid();
      $this->validatedForm['created_by'] = 'admin';
      $this->validatedForm['updated_by'] = 'admin';
      $this->validatedForm['status'] = 'pending';
      $this->validatedForm['number'] = 'tes1';



      $salesOrder = $this->headerModel::create($this->validatedForm);
      $detailData = $this->detailModel::insert([
        'id' => $this->validatedFormDetail['id'],
        'sales_order_id' => $salesOrder->id,
        'product_id' => $this->validatedFormDetail['product_id'],
        'selling_price' => $this->validatedFormDetail['selling_price'],
        'qty' => $this->validatedFormDetail['qty'],
        'created_by' => $this->validatedFormDetail['created_by'],
        'updated_by' => $this->validatedFormDetail['updated_by'],
        'created_at' => $this->validatedFormDetail['created_at'],
        'updated_at' => $this->validatedFormDetail['updated_at'],
        'is_activated' => $this->validatedFormDetail['is_activated'],
      ]);

      $this->masterForm->reset();
      $this->masterFormDetail->reset();
      $this->details = [];

      $this->success('Sales Order Created.');
    } catch (\Throwable $e) {
      DB::rollBack();
      \Log::error('Failed to Store  Sales Order: ' . $e->getMessage());
      $this->error('Failed to Store  Sales Order.');
    }
  }


  public function createDetail()
  {

    if ($this->detailId) {
      $this->editDetail($this->detailId);
    }

    $this->masterFormDetail->reset();
    $this->modalDetail = true;

    if ($this->detailId) {
      $this->editDetail($this->detailId);
    }
  }

  public function editDetail($detailId)
  {
    $this->detailId = $detailId;
    $detail = collect($this->details)->firstWhere('id', $detailId);
    if ($detail) {
      $this->masterFormDetail->fill($detail);
      $this->modalDetail = true;
    } else {
      session()->flash('error', 'Detail tidak ditemukan.');
    }
  }


  public function updateDetail()
  {
    $validated = $this->validate(
      $this->masterFormDetail->rules(),
      [],
      $this->masterFormDetail->attributes()
    )['masterFormDetail'];

    foreach ($this->details as $index => $detail) {
      if ($detail['id'] === $this->detailId) {
        $validated['id'] = $this->detailId;
        $this->details[$index] = $validated;
        break;
      }
    }

    $this->reset(['modalDetail', 'detailId']);
  }


  public function deleteDetail($id)
  {
    foreach ($this->details as $index => $detail) {
      if ($detail['id'] === $id) {
        unset($this->details[$index]);
        // Re-index array agar $loop->iteration tetap berurutan di tampilan
        $this->details = array_values($this->details);
        break;
      }
    }

    session()->flash('message', 'Detail berhasil dihapus.');
  }


  public function storeDetail()
  {
    if ($this->detailId) {
      $this->editDetail($this->detailId);
    }

    $this->validatedFormDetail = $this->validate(
      $this->masterFormDetail->rules(),
      [],
      $this->masterFormDetail->attributes()
    )['masterFormDetail'];


    try {

      $this->validatedFormDetail['created_by'] = 'admin';
      $this->validatedFormDetail['updated_by'] = 'admin';

      $this->validatedFormDetail['created_at'] = now();
      $this->validatedFormDetail['updated_at'] = now();

      $this->details[] = $this->validatedFormDetail;

      $this->modalDetail = false;

      $this->success('Data has been stored');
    } catch (\Throwable $th) {
      \Log::error('Data failed to store: ' . $th->getMessage());
      $this->error('Data failed to store');
    }
  }


  #[Computed]
  public function customers()
  {
    return Customer::get()
      ->map(function ($customer) {
        return [
          'id' => $customer->id,
          'first_name' => $customer->first_name,
          'last_name' => $customer->last_name,
          'name' => trim($customer->first_name . ' ' . $customer->last_name),
        ];
      })
      ->toArray();
  }


  #[Computed]
  public function products()
  {
    return Product::get()
      ->toArray();
  }

  #[Computed]
  public function employees()
  {
    return Employee::get()
      ->toArray();
  }

  #[Computed]
  public function customer()
  {
    $masterData = $this->headerModel::query()
      ->join('customers', 'sales_orders.customer_id', 'customers.id')

      ->select([
        'sales_orders.id',
        'customers.id as customer_id',
        'customers.first_name as customer_first_name',
      ])->where('sales_orders.id', $this->id)->first();

    return $masterData;
  }
}
