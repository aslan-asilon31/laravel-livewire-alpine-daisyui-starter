<?php

namespace App\Livewire\Pages\Admin\Sales\CustomerResources;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Customer;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Livewire\Pages\Admin\Contents\CustomerResources\Forms\CustomerForm;
use Mary\Traits\Toast;

class CustomerList extends Component
{

  public string $title = "Customers";
  public string $url = "/customers";

  #[\Livewire\Attributes\Locked]
  public $id;

  use Toast;
  use WithPagination;

  #[Url(except: '')]
  public ?string $search = '';

  public bool $filterDrawer;

  public array $sortBy = ['column' => 'first_name', 'direction' => 'desc'];

  #[Url(except: '')]
  public array $filters = [];
  public array $filterForm = [
    'first_name' => '',
    'last_name' => '',
    'phone' => '',
    'email' => '',
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
      ['key' => 'id', 'label' => 'ID', 'sortBy' => 'id', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'first_name', 'label' => 'First Name', 'sortBy' => 'first_name', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'last_name', 'label' => 'Last Name', 'sortBy' => 'last_name', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'phone', 'label' => 'Phone', 'sortBy' => 'phone',  'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'email', 'label' => 'Email', 'sortBy' => 'email',  'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'created_by', 'label' => 'Created By', 'sortBy' => 'created_by',  'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'updated_by', 'label' => 'Updated By', 'sortBy' => 'updated_by',  'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'created_at', 'label' => 'Created At', 'format' => ['date', 'Y-m-d H:i:s'], 'sortBy' => 'created_at', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
      ['key' => 'updated_at', 'label' => 'Updated At', 'sortBy' => 'updated_at', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'is_activated', 'label' => 'Activate', 'sortBy' => 'is_activated', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
    ];
  }

  #[Computed]
  public function rows(): LengthAwarePaginator
  {

    $query = Customer::query();

    $query->when($this->search, fn($q) => $q->where('first_name', 'like', "%{$this->search}%"))
      ->when(($this->filters['first_name'] ?? ''), fn($q) => $q->where('first_name', 'like', "%{$this->filters['first_name']}%"))
      ->when(($this->filters['last_name'] ?? ''), fn($q) => $q->where('last_name', 'like', "%{$this->filters['last_name']}%"))
      ->when(($this->filters['phone'] ?? ''), fn($q) => $q->where('phone', 'like', "%{$this->filters['phone']}%"))
      ->when(($this->filters['email'] ?? ''), fn($q) => $q->where('email', 'like', "%{$this->filters['email']}%"))
      ->when(($this->filters['created_by'] ?? ''), fn($q) => $q->where('created_by', 'like', "%{$this->filters['created_by']}%"))
      ->when(($this->filters['updated_by'] ?? ''), fn($q) => $q->where('updated_by', 'like', "%{$this->filters['created_by']}%"))
      ->when((($this->filters['is_activated'] ?? '') != ''), fn($q) => $q->where('is_activated', $this->filters['is_activated']))
      ->when(($this->filters['created_at'] ?? ''), function ($q) {
        $dateTime = $this->filters['created_at'];
        $dateOnly = substr($dateTime, 0, 10);
        $q->whereDate('created_at', $dateOnly);
      })
      ->when(($this->filters['updated_at'] ?? ''), function ($q) {
        $dateTime = $this->filters['updated_at'];
        $dateOnly = substr($dateTime, 0, 10);
        $q->whereDate('updated_at', $dateOnly);
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
        'filterForm.first_name' => 'nullable|string',
        'filterForm.last_name' => 'nullable|string',
        'filterForm.phone' => 'nullable|string',
        'filterForm.email' => 'nullable|string',
        'filterForm.created_by' => 'nullable|string',
        'filterForm.updated_by' => 'nullable|string',
        'filterForm.is_activated' => 'nullable|integer',
        'filterForm.created_at' => 'nullable|string',
        'filterForm.updated_at' => 'nullable|string',
      ],
      [],
      [
        'filterForm.first_name' => 'First Name',
        'filterForm.last_name' => 'Last Name',
        'filterForm.phone' => 'Phone',
        'filterForm.email' => 'Email',
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
    $masterData = Customer::findOrFail($this->id);

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
    return view('livewire.pages.admin.sales.customer-resources.customer-list')
      ->title($this->title);
  }
}
