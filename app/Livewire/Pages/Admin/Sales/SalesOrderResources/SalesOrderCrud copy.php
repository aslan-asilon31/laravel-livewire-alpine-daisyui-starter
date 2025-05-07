<?php

namespace App\Livewire\Pages\Admin\Sales\SalesOrderResources;

use App\Models\SalesOrder;
use App\Models\SalesOrderDetail;
use Illuminate\Support\Collection;
use Livewire\Component;
use App\Livewire\Pages\Admin\Sales\SalesOrderResources\Forms\SalesOrderForm;
use App\Livewire\Pages\Admin\Sales\SalesOrderResources\Forms\SalesOrderDetailForm;


class SalesOrderCrud extends Component
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

  public string $title = 'Sales Order Crud';
  public ?string $id = '';
  public string $url = '/sales-orders';


  public array $details = [];

  public function mount()
  {
    if ($this->id && $this->readonly) {
      $this->title .= ' (Show)';
      $this->show();
    } else if ($this->id) {
      $this->title .= ' (Edit)';
      $this->edit();
    } else {
      $this->title .= ' (Create)';
      $this->create();
    }
    $this->searchCustomer();
    $this->searchEmployee();
    $this->searchProduct();
  }

  public function edit()
  {
    $headerData = $this->headerModel::findOrFail($this->id);
    $this->headerForm->fill($headerData);

    // $detailData = $this->detailModel::where('sales_order_id', $this->id)->get()->toArray();


    $detailData = $this->detailModel::query()
      ->join('products', 'sales_order_detail.product_id', 'products.id')
      ->select([
        'sales_order_detail.*',
        'products.id as product_id',
        'products.name as product_name',
      ])->where('sales_order_detail.sales_order_id', $this->id)->get()->toArray();
    $this->details = $detailData;
  }

  public function show() {}

  public function create()
  {
    $this->headerForm->reset();
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

  public int $detailIndex;



  // hook detail

  public function getSelectedProductName()
  {
    $productId = $this->detailForm->product_id ?? null;
    if (!$productId) {
      return null;
    }
    $product = \App\Models\Product::find($productId);
    return $product ? $product->name : null;
  }

  public Collection $productsSearchable;
  public function searchProduct(string $value = '')
  {
    $selectedOption = \App\Models\Product::where('id', $this->detailForm->product_id ?? null)->get();
    $this->productsSearchable = \App\Models\Product::query()
      ->where('name', 'like', "%$value%")
      ->orderBy('name')
      ->get()
      ->merge($selectedOption);
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


  // public function updatedDetailFormProductId($productId)
  // {
  //   $product = \App\Models\Product::findOrFail($productId);
  //   $this->detailForm['product_name'] = $product->name;
  //   $this->detailForm['selling_price'] = (float) $product->selling_price;
  //   $this->detailForm['qty'] = 1;
  // }
  // ./hook detail

  // hook header
  public Collection $employeesSearchable;
  public function searchEmployee(string $value = '')
  {
    $selectedOption = \App\Models\Employee::where('id', $this->headerForm->employee_id)->get();

    $this->employeesSearchable = \App\Models\Employee::query()
      ->where('name', 'like', "%$value%")
      ->orderBy('name')
      ->get()
      ->merge($selectedOption);
  }

  public Collection $customersSearchable;
  public function searchCustomer(string $value = '')
  {
    $selectedOption = \App\Models\Customer::where('id', $this->headerForm->customer_id)->get();
    $this->customersSearchable = \App\Models\Customer::query()
      ->where('first_name', 'like', "%$value%")
      ->orderBy('created_at')
      ->get()
      ->merge($selectedOption);
  }
  // ./hook header
}
