<?php

namespace App\Livewire\Pages\Admin\Sales\SalesOrderResources;

use Livewire\Component;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Product;
use App\Models\SalesOrder;
use App\Models\SalesOrderDetail;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Illuminate\Support\Collection;

class SalesOrderEdit extends Component
{
  public function render()
  {
    return view('livewire.pages.admin.sales.sales-order-resources.sales-order-edit')
      ->title($this->title);
  }

  public string $title = 'Sales Order';
  public ?string $id = '';

  public string $url = '/sales-orders';

  public array $headerForm = [
    'number' => '',
    'employee_id' => '',
    'customer_id' => '',
    'date' => '',
    'status' => 'Pending',
    'is_activated' => 1,
  ];

  public array $details = [];

  public $headerModel = \App\Models\SalesOrder::class;
  public $detailModel = \App\Models\SalesOrderDetail::class;

  public function mount()
  {
    //Tambahan Edit
    $header = $this->headerModel::findOrFail($this->id)->toArray();
    $details = $this->detailModel::query()
      ->join('products', 'sales_order_detail.product_id', 'products.id')
      ->select([
        'sales_order_detail.*',
        'products.name AS product_name',
      ])
      ->where('sales_order_id', $this->id)->get()->toArray();

    $this->headerForm = $header;
    $this->details = $details;
    // ./Tambahan Edit

    $this->searchEmployee();
    $this->searchCustomer();
    $this->searchProduct();
  }
  public function store()
  {
    $this->headerForm['number'] = rand(1000000, 999999);
    $validatedHeaderForm = $this->headerForm;
    $header = $this->headerModel::create($validatedHeaderForm);

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

    $this->detailModel::insert($details);
  }

  public function update()
  {
    $validatedHeaderForm = $this->headerForm;
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
  }

  public int $detailIndex = -1;
  public array $detailForm = [
    'product_id' => '',
    'product_name' => '',
    'selling_price' => 0,
    'qty' => 0,
  ];
  public function createDetail()
  {
    $this->reset('detailForm');
  }
  public function storeDetail()
  {
    $validatedDetailForm = $this->detailForm;
    $this->details[] =  $validatedDetailForm;

    $this->reset('detailForm');
  }

  public function editDetail($detailIndex)
  {
    $this->detailIndex = $detailIndex;
    $this->detailForm = $this->details[$this->detailIndex];
    $this->searchProduct();
  }

  public function updateDetail()
  {
    $this->details[$this->detailIndex] = $this->detailForm;
    $this->reset(['detailForm', 'detailIndex']);
  }

  public function deleteDetail($detailIndex)
  {
    unset($this->details[$detailIndex]);
    $this->details = array_values($this->details);
  }

  // hook detail
  public Collection $productsSearchable;
  public function searchProduct(string $value = '')
  {
    $selectedOption = \App\Models\Product::where('id', $this->detailForm['product_id'])->get();
    $this->productsSearchable = \App\Models\Product::query()
      ->where('name', 'like', "%$value%")
      ->take(5)
      ->orderBy('name')
      ->get()
      ->merge($selectedOption);
  }

  public function updatedDetailFormProductId($productId)
  {
    $product = \App\Models\Product::findOrFail($productId);
    $this->detailForm['product_name'] = $product->name;
    $this->detailForm['selling_price'] = (float) $product->selling_price;
    $this->detailForm['qty'] = 1;
  }
  // ./hook detail

  // hook header
  public Collection $employeesSearchable;
  public function searchEmployee(string $value = '')
  {
    $selectedOption = \App\Models\Employee::where('id', $this->headerForm['employee_id'])->get();

    $this->employeesSearchable = \App\Models\Employee::query()
      ->where('name', 'like', "%$value%")
      ->take(5)
      ->orderBy('name')
      ->get()
      ->merge($selectedOption);
  }

  public Collection $customersSearchable;
  public function searchCustomer(string $value = '')
  {
    $selectedOption = \App\Models\Customer::where('id', $this->headerForm['customer_id'])->get();

    $this->customersSearchable = \App\Models\Customer::query()
      ->where('first_name', 'like', "%$value%")
      ->take(5)
      ->orderBy('first_name')
      ->get()
      ->merge($selectedOption);
  }
  // ./hook header
}
