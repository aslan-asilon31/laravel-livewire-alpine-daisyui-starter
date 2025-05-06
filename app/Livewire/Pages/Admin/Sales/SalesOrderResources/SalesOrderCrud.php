<?php

namespace App\Livewire\Pages\Admin\Sales\SalesOrderResources;

use App\Models\SalesOrder;
use App\Models\SalesOrderDetail;
use Illuminate\Support\Collection;
use Livewire\Component;

class SalesOrderCrud extends Component
{
  public function render()
  {
    return view('livewire.pages.admin.sales.sales-order-resources.sales-order-crud')
      ->title($this->title);
  }

  public string $title = 'Sales Order Crud';
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

  public function mount()
  {

    $this->searchEmployee();
    $this->searchCustomer();
    $this->searchProduct();

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

  }

  public function create()
  {
    $this->reset('headerForm');

  }


  public function store()
  {
    $this->headerForm['number'] = rand(1000000, 999999);
    $validatedHeaderForm = $this->headerForm;
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
