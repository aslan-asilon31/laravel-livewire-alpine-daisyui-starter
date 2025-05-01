<?php

namespace App\Livewire\Pages\Admin\Sales\SalesOrderDetailResources;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\SalesOrder;
use App\Models\SalesOrderDetail;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Mary\Traits\Toast;

class SalesOrderDetailList extends Component
{

  public string $title = "Sales Order Detail";
  public string $url = "/sales-order-details";

  #[\Livewire\Attributes\Locked]
  public $id;

  use Toast;
  use WithPagination;

  #[Url(except: '')]
  public ?string $search = '';

  public bool $filterDrawer;

  public array $sortBy = ['column' => 'name', 'direction' => 'desc'];

  #[Url(except: '')]
  public array $filters = [];
  public array $filterForm = [
    'name' => '',
    'status' => '',
    'created_by' => '',
    'updated_by' => '',
    'created_at' => '',
    'updated_at' => '',
  ];


  public function mount() {}

  #[Computed]
  public function headers(): array
  {
    return [
      ['key' => 'action', 'label' => 'Action', 'sortable' => false, 'class' => 'whitespace-nowrap border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
      ['key' => 'no_urut', 'label' => '#', 'sortable' => false, 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'id', 'label' => 'ID', 'sortable' => false, 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
      ['key' => 'name', 'sortBy' => 'name',  'label' => 'First Name', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'selling_price', 'sortBy' => 'selling_price',  'label' => 'Selling Price', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'qty', 'sortBy' => 'qty',  'label' => 'Quantity', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'updated_by', 'sortBy' => 'updated_by',  'label' => 'Updated By', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'created_at', 'sortBy' => 'created_at',  'label' => 'Created At', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'updated_at', 'sortBy' => 'updated_at',  'label' => 'Updated At', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'is_activated', 'sortBy' => 'is_activated',  'label' => 'Is Activated', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right']
    ];
  }

  #[Computed]
  public function rows(): LengthAwarePaginator
  {

    $query = SalesOrderDetail::query()
      ->join('sales_orders', 'sales_order_detail.sales_order_id', 'sales_orders.id')
      ->join('products', 'sales_order_detail.product_id', 'products.id')
      ->select(
        'sales_order_detail.*',
        'products.id as product_id',
        'products.name',
      );

    $query->when($this->search, fn($q) => $q->where('sales_orders.name', 'like', "%{$this->search}%"))
      ->when(($this->filters['id'] ?? ''), fn($q) => $q->where('sales_order_detail.id', 'like', "%{$this->filters['id']}%"))
      ->when(($this->filters['selling_price'] ?? ''), fn($q) => $q->where('sales_order_detail.selling_price', 'like', "%{$this->filters['selling_price']}%"))
      ->when(($this->filters['qty'] ?? ''), fn($q) => $q->where('sales_order_detail.qty', 'like', "%{$this->filters['qty']}%"))
      ->when(($this->filters['created_by'] ?? ''), fn($q) => $q->where('created_by', 'like', "%{$this->filters['created_by']}%"))
      ->when(($this->filters['updated_by'] ?? ''), fn($q) => $q->where('updated_by', 'like', "%{$this->filters['created_by']}%"))
      ->when((($this->filters['is_activated'] ?? '') != ''), fn($q) => $q->where('is_activated', $this->filters['is_activated']))
      ->when(($this->filters['sales_order_detail.created_at'] ?? ''), function ($q) {
        $dateTime = $this->filters['sales_order_detail.created_at'];
        $dateOnly = substr($dateTime, 0, 10);
        $q->whereDate('sales_order_detail.created_at', $dateOnly);
      })
      ->when(($this->filters['sales_order_detail.updated_at'] ?? ''), function ($q) {
        $dateTime = $this->filters['sales_order_detail.updated_at'];
        $dateOnly = substr($dateTime, 0, 10);
        $q->whereDate('sales_order_detail.updated_at', $dateOnly);
      });

    $paginator = $query
      ->orderBy(...array_values($this->sortBy))
      ->paginate(20);

    $start = ($paginator->currentPage() - 1) * $paginator->perPage();

    $paginator->getCollection()->transform(function ($item, $key) use ($start) {
      $item->no_urut = $start + $key + 1;
      return $item;
    });

    return $paginator;
  }

  public function filter()
  {
    $validatedFilters = $this->validate(
      [
        'filterForm.id' => 'nullable|string',
        'filterForm.name' => 'nullable|string',
        'filterForm.number' => 'nullable|string',
        'filterForm.selling_price' => 'nullable|integer',
        'filterForm.qty' => 'nullable|integer',
        'filterForm.created_by' => 'nullable|string',
        'filterForm.updated_by' => 'nullable|string',
        'filterForm.is_activated' => 'nullable|integer',
        'filterForm.created_at' => 'nullable|string',
        'filterForm.updated_at' => 'nullable|string',
      ],
      [],
      [
        'filterForm.id' => 'First Name',
        'filterForm.name' => 'Name',
        'filterForm.selling_price' => 'Selling Price',
        'filterForm.qty' => 'Quantity',
        'filterForm.created_by' => 'Created By',
        'filterForm.updated_by' => 'Updated By',
        'filterForm.is_activated' => 'Is Activated',
        'filterForm.created_at' => 'Created At',
        'filterForm.updated_at' => 'Updated At',
      ]
    )['filterForm'];



    $this->filters = collect($validatedFilters)->reject(fn($value) => $value === '')->toArray();
    $this->success('Filter Result');
    $this->filterDrawer = false;
  }

  public function clear(): void
  {
    $this->reset('filters');
    $this->reset('filterForm');
    $this->success('filter cleared');
  }

  public function delete()
  {
    $masterData = SalesOrder::findOrFail($this->id);

    \Illuminate\Support\Facades\DB::beginTransaction();
    try {

      $this->deleteImage($masterData['image_url']);

      $masterData->delete();
      \Illuminate\Support\Facades\DB::commit();

      $this->success('Data has been deleted');
      $this->redirect($this->url, true);
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      $this->error('Data failed to delete');
    }
  }

  public function render()
  {
    return view('livewire.pages.admin.sales.sales-order-detail-resources.sales-order-detail-list')
      ->title($this->title);
  }
}
