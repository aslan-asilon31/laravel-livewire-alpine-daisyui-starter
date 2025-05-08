<?php

namespace App\Livewire\Pages\Admin\Sales\SalesOrderResources;

use Livewire\Component;
use App\Livewire\Pages\Admin\Sales\SalesOrderResources\Forms\SalesOrderForm;
use App\Livewire\Pages\Admin\Sales\SalesOrderResources\Forms\SalesOrderDetailForm;

class SalesOrderShow extends Component
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


  public string $title = 'Sales Order Edit';
  public ?string $id = '';
  public string $url = '/sales-orders/edit';

  public array $details = [];

  public function mount()
  {
    $this->isReadonly = true;
    $this->isDisabled = true;

    $headerData = $this->headerModel::findOrFail($this->id);
    $this->headerForm->fill($headerData);

    $details = $this->detailModel::query()
      ->join('products', 'sales_order_detail.product_id', 'products.id')
      ->select([
        'sales_order_detail.*',
        'products.id as product_id',
        'products.name as product_name',
      ])->where('sales_order_detail.sales_order_id', $this->id)->get()->toArray();
    $this->details = $details;

    $this->searchEmployee();
    $this->searchProduct();
    $this->searchCustomer();
  }
}
