<?php

namespace App\Livewire\Pages\Admin\Sales\SalesOrderResources;

use App\Models\SalesOrder;
use App\Models\SalesOrderDetail;
use Illuminate\Support\Collection;
use Livewire\Component;
use App\Livewire\Pages\Admin\Sales\SalesOrderResources\Forms\SalesOrderForm;
use App\Livewire\Pages\Admin\Sales\SalesOrderResources\Forms\SalesOrderDetailForm;


class SalesOrderCreate extends Component
{

  use \App\Helpers\FormHook\Traits\WithSalesOrder;
  use \Mary\Traits\Toast;

  public SalesOrderForm $headerForm;
  public SalesOrderDetailForm $detailForm;

  public function render()
  {
    return view('livewire.pages.admin.sales.sales-order-resources.sales-order-crud')
      ->title($this->title);
  }

  public string $title = 'Sales Order Create';
  public ?string $id = '';
  public string $url = '/sales-orders/create';


  public array $details = [];

  public function mount()
  {

    $this->headerForm->reset();

    $this->searchCustomer();
    $this->searchEmployee();
    $this->searchProduct();
  }


  public function store()
  {
    $this->headerForm->number = rand(1000000, 999999);
    $this->headerForm->status = "pending";
    $validatedHeaderForm = $this->validate(
      $this->headerForm->rules(),
      [],
      $this->headerForm->attributes()
    )['headerForm'];

    $header = SalesOrder::create($validatedHeaderForm);

    $details = collect($this->details)
      ->map(function ($detail, $index) use ($header) {
        return [
          'id' => str()->orderedUuid()->toString(),
          'sales_order_id' => $header->id,
          'product_id' => $detail['product_id'],
          'selling_price' => $detail['selling_price'],
          'qty' => $detail['qty'],
        ];
      })
      ->toArray();

    $header = SalesOrderDetail::insert($details);
    $this->headerForm->reset();
    $this->reset('details');
    $this->success('Sales Order Created.');
  }
}
