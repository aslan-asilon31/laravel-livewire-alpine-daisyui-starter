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
use Illuminate\Support\Collection;


class SalesOrderCreate extends Component
{
  public function render()
  {
    return view('livewire.pages.admin.sales.sales-order-resources.sales-order-create')
      ->title($this->title);
  }

  use \Mary\Traits\Toast;
  use \App\Helpers\FormHook\Traits\WithSalesOrderHook;

  #[\Livewire\Attributes\Locked]
  private string $basePageName = 'sales-order';

  #[\Livewire\Attributes\Locked]
  public string $title = 'Sales Order';

  #[\Livewire\Attributes\Locked]
  public string $url = '/sales-orders';


  #[\Livewire\Attributes\Locked]
  private string $baseImageName = 'sales_order_image';


  public function mount()
  {
    $this->searchEmployee();
    $this->searchProduct();
    $this->searchCustomer();
  }

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
