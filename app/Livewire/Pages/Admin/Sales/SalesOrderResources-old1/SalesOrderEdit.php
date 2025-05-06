<?php

namespace App\Livewire\Pages\Admin\Sales\SalesOrderResources;

use Livewire\Component;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Product;
use App\Models\SalesOrderDetail;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Illuminate\Support\Collection;

class SalesOrderEdit extends Component
{

  public string $selectedTab = 'sales-order-tab';

  public function render()
  {
    return view('livewire.pages.admin.sales.sales-order-resources.sales-order-edit')
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


  // public function mount()
  // {
  //   $this->edit();
  // }


  public function mount()
  {

    $masterData = $this->headerModel::query()
      ->join('customers', 'sales_orders.customer_id', 'customers.id')
      ->join('employees', 'sales_orders.employee_id', 'employees.id')
      ->select([
        'customers.id as customer_id',
        'employees.id as employee_id',
        'sales_orders.id',
        'employees.name as employee_name',
        'customers.first_name',
        'customers.last_name',
        'customers.phone',
        'sales_orders.date',
        'sales_orders.number',
        'sales_orders.status',
        'sales_orders.fraud_status',
        'sales_orders.updated_by',
        'sales_orders.created_at',
        'sales_orders.updated_at',
        'sales_orders.is_activated',
      ])->findOrFail($this->id);

    $this->masterForm->fill($masterData->toArray());

    // $this->SalesOrderDetailInitialize();

    $this->searchCustomer();
    $this->searchEmployee();
    $this->searchProduct();
  }




  public function search(string $value = '')
  {

    $data = Customer::query()
      ->select([
        'customers.id',
        DB::raw("CONCAT(customers.first_name, ' ', customers.last_name) as name"),
      ])->where('customers.first_name', 'like', "%$value%")
      ->orderBy('customers.created_at')
      ->get();
  }




  // public function SalesOrderDetailInitialize()
  // {

  //   $masterDataDetail = SalesOrderDetail::query()
  //     ->join('sales_orders', 'sales_order_detail.sales_order_id', 'sales_orders.id')
  //     ->join('products', 'sales_order_detail.product_id', 'products.id')
  //     ->select(
  //       'sales_order_detail.*',
  //       'products.id as product_id',
  //       'products.name',
  //     )->where('sales_order_id', $this->id)->first();

  //   $this->masterFormDetail->fill($masterDataDetail?->toArray() ?? []);
  // }



  public function updateSalesOrderDetail()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $masterData = $this->headerModel::findOrFail($this->id);

    $validatedForm['updated_by'] = 'admin';

    DB::beginTransaction();
    try {

      dd($validatedForm);

      \App\Models\SalesOrderDetail::where('id', $this->id)->update([
        'selling_price' => $validatedForm['selling_price'],
        'qty' => $validatedForm['qty'],
        'is_activated' => $validatedForm['is_activated'],
      ]);


      $masterDataProduct = \App\Models\Product::find($validatedForm['product_id']);
      $masterDataProduct->update([
        'id' => $validatedForm['product_id'],
      ]);

      DB::commit();

      $this->success('Data has been updated');
    } catch (\Throwable $th) {
      DB::rollBack();
      $this->error('Data failed to update');

      // Catat log error detail untuk debug
      \Log::error('Update failed:', [
        'error' => $th->getMessage(),
        'validatedForm' => $validatedForm,
        'id' => $this->id
      ]);
    }
  }







  public function update()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];


    $masterData = $this->headerModel::findOrFail($this->id);

    $validatedForm['updated_by'] = 'admin';

    DB::beginTransaction();
    try {

      $sales_orders = \App\Models\SalesOrder::where('id', $this->id)->update([
        'customer_id' => $validatedForm['customer_id'],
        'employee_id' => $validatedForm['employee_id'],
        'date' => $validatedForm['date'],
        'is_activated' => $validatedForm['is_activated'],
        'updated_by' => 'admin',
        'updated_at' => now(),
      ]);

      DB::commit();

      $this->success('Data has been updated');
    } catch (\Throwable $th) {
      DB::rollBack();
      $this->error('Data failed to update');

      // Catat log error detail untuk debug
      \Log::error('Update failed:', [
        'error' => $th->getMessage(),
        'validatedForm' => $validatedForm,
        'id' => $this->id
      ]);
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

  public function delete()
  {

    $masterData = $this->headerModel::findOrFail($this->id);

    \Illuminate\Support\Facades\DB::beginTransaction();
    try {

      $masterData->delete();
      \Illuminate\Support\Facades\DB::commit();

      $this->success('Data has been deleted');
      $this->redirect($this->url, true);
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      $this->error('Data failed to delete');
    }
  }
}
