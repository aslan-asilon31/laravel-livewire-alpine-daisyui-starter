<?php

namespace App\Livewire\Pages\Admin\Sales\SalesOrderResources;

use App\Models\SalesOrder;
use App\Models\SalesOrderDetail;
use Illuminate\Support\Collection;
use Livewire\Component;
use App\Livewire\Pages\Admin\Sales\SalesOrderResources\Forms\SalesOrderForm;
use App\Livewire\Pages\Admin\Sales\SalesOrderResources\Forms\SalesOrderDetailForm;
use Livewire\Attributes\Computed;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class SalesOrderEdit extends Component
{

  use \App\Helpers\FormHook\Traits\WithSalesOrder;
  use \Mary\Traits\Toast;
  use WithPagination;

  #[Url(except: '')]
  public ?string $search = '';

  public bool $filterDrawer;

  public array $sortBy = ['column' => 'product_name', 'direction' => 'desc'];


  public SalesOrderForm $headerForm;
  public SalesOrderDetailForm $detailForm;

  public function render()
  {
    return view('livewire.pages.admin.sales.sales-order-resources.sales-order-crud')
      ->title($this->title);
  }

  #[Url(except: '')]
  public array $filters = [];
  public array $filterForm = [
    'product_name' => '',
    'selling_price' => '',
    'qty' => '',
  ];


  public string $title = 'Sales Order Edit';
  public ?string $id = '';
  public string $url = '/sales-orders/edit';

  public array $details = [];

  public function mount()
  {
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


  public function update()
  {
    $validatedHeaderForm = $this->validate(
      $this->headerForm->rules(),
      [],
      $this->headerForm->attributes()
    )['headerForm'];

    $header = $this->headerModel::findOrFail($this->id);
    $header->update($validatedHeaderForm);
    $details = collect($this->details)
      ->map(function ($detail, $index) use ($header) {
        return [
          'id' => $detail['id'] ? $detail['id'] : str()->orderedUuid()->toString(),
          'sales_order_id' => $header->id,
          'product_id' => $detail['product_id'],
          'selling_price' => $detail['selling_price'],
          'qty' => $detail['qty'],
        ];
      })
      ->toArray();

    $this->detailModel::where('sales_order_id', $this->id)->delete();
    $this->detailModel::insert($details);

    $this->success('Sales Order Updated.');
  }
}
