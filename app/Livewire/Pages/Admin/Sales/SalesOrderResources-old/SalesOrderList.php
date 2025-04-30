<?php

namespace App\Livewire\Pages\Admin\Sales\SalesOrderResources;

use Livewire\Component;
use App\Models\SalesOrder;
use Mary\Traits\Toast;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Url;
use Livewire\Attributes\Computed;

class SalesOrderList extends Component
{

  public string $url = '/sales-orders';
  public string $title = 'Sales Order';


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
    'date' => '',
    'number' => '',
    'status' => '',
    'created_by' => '',
    'updated_by' => '',
    'created_at' => '',
    'updated_at' => '',
  ];

  public function render()
  {
    return view('livewire.pages.admin.sales.sales-order-resources.sales-order-list')
      ->title($this->title);
  }

  #[Computed]
  public function headers(): array
  {
    return [
      ['key' => 'action', 'label' => 'Action', 'sortable' => false, 'class' => 'whitespace-nowrap border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
      ['key' => 'no_urut', 'label' => '#', 'sortable' => false, 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'id', 'label' => 'ID', 'sortBy' => 'id', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'first_name', 'label' => 'First Name', 'sortBy' => 'first_name', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'last_name', 'label' => 'Last Name', 'sortBy' => 'last_name', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'date', 'label' => 'Date', 'sortBy' => 'dat',  'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-left'],
      ['key' => 'number', 'label' => 'Number', 'sortBy' => 'number',  'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'date', 'label' => 'Date', 'sortBy' => 'date',  'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'created_by', 'label' => 'Created By', 'sortBy' => 'created_by',  'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'updated_by', 'label' => 'Updated By', 'sortBy' => 'updated_by',  'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'created_at', 'label' => 'Created At', 'format' => ['date', 'Y-m-d H:i:s'], 'sortBy' => 'created_at', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
      ['key' => 'updated_at', 'label' => 'Updated At', 'sortBy' => 'updated_at', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-right'],
      ['key' => 'is_activated', 'label' => 'Activate', 'sortBy' => 'is_activated', 'class' => 'whitespace-nowrap  border-1 border-l-1 border-gray-300 dark:border-gray-600 text-center'],
    ];
  }

  public function amount() {}


  public $salesOrderStatusPending;
  public $salesOrderStatusSettlement;
  public $salesOrderStatusExpired;
  public $salesOrderFraudStatusIdentify;
  public $salesOrderFraudStatusAccept;
  public $salesOrderIsActivateYes;
  public $salesOrderIsActivateNo;



  #[\Livewire\Attributes\Locked]
  private string $basePageName = 'page';
}
