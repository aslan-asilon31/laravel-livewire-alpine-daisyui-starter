<?php

namespace App\Livewire\Pages\Admin\Sales\SalesOrderResources;

use App\Livewire\Pages\Admin\Sales\SalesOrderResources\Forms\SalesOrderForm;
use Livewire\Component;
use Illuminate\Support\Facades\DB;


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

  public SalesOrderForm $masterForm;


  public function mount()
  {

    $masterData = $this->masterModel::query()
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

    if ($masterData) {

      $this->masterForm->fill($masterData->toArray());
    } else {
      $this->error('Data tidak ditemukan');
    }
  }

  public function update()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    $masterData = $this->masterModel::findOrFail($this->id);

    $validatedForm['updated_by'] = 'admin';

    DB::beginTransaction();
    try {

      $sales_orders = \App\Models\SalesOrder::where('id', $this->id)->update([
        'date' => $validatedForm['date'],
        'number' => $validatedForm['number'],
        'status' => $validatedForm['status'],
        'is_activated' => $validatedForm['is_activated'],
      ]);

      $masterDataCustomer = \App\Models\Customer::find($validatedForm['customer_id']);
      $masterDataCustomer->update([
        'id' => $validatedForm['customer_id'],
        'first_name' => $validatedForm['first_name'],
        'last_name' => $validatedForm['last_name'],
        'phone' => $validatedForm['phone'],
      ]);

      $masterDataEmployee = \App\Models\Employee::find($validatedForm['employee_id']);
      $masterDataEmployee->update([
        'name' => $validatedForm['employee_name'],
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


  // public function update()
  // {

  //   $validatedForm = $this->validate(
  //     $this->masterForm->rules(),
  //     [],
  //     $this->masterForm->attributes()
  //   )['masterForm'];

  //   $masterData = $this->masterModel::findOrFail($this->id);


  //   unset($validatedForm['customer_id']);
  //   unset($validatedForm['employee_id']);
  //   unset($validatedForm['first_name']);
  //   unset($validatedForm['last_name']);
  //   unset($validatedForm['employee_name']);


  //   \Illuminate\Support\Facades\DB::beginTransaction();
  //   try {


  //     $validatedForm['updated_by'] = 'admin';
  //     $masterData->update($validatedForm);

  //     \Illuminate\Support\Facades\DB::commit();

  //     $this->success('Data has been updated');
  //   } catch (\Throwable $th) {
  //     \Illuminate\Support\Facades\DB::rollBack();
  //     $this->error('Data failed to update');
  //     \Log::error('Store data failed: ' . $th->getMessage());
  //   }
  // }

  public function delete()
  {

    $masterData = $this->masterModel::findOrFail($this->id);

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
