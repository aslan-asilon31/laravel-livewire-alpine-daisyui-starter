<?php

namespace App\Livewire\Pages\Admin\Sales\CustomerResources;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator; 
use Mary\Traits\Toast;

class CustomerList extends Component
{
  
  public $url = '/customers';
  public $title = 'Customers';
  

  use WithPagination;

  public $customerPaginators;

  public Collection $customersSearchable;
  public Collection $customersMultiSearchable;

  public  $customer_searchable_id;
  public  $customers_multi_searchable_ids;

  public $cell_decoration ;
  public $CustomersFilter ;
  public $drawer = false ;

  #[Locked] 
  public $customerId;

  #[Url]
  public ?string $search = '';

  public array $sortBy = ['column' => 'name', 'direction' => 'asc'];


  public function render()
  {
    return view('livewire.pages.admin.sales.customer-resources.customer-list')
      ->title($this->title);
  }

  public function mount()
  {




    $this->cell_decoration = [


    ];


    $this->search();

  }

  
  #[Computed]
  public function customers(): LengthAwarePaginator 
  {
      $customers = Customer::where('first_name', 'LIKE', "%{$this->search}%")->paginate(5);
      return $customers;
  }
  
  #[Computed]
  public function headers(): array
  {
      return [
          ['key' => 'action', 'label' => 'Action'],
          ['key' => 'id', 'label' => 'ID'],
          ['key' => 'first_name', 'label' => 'First Name'],
          ['key' => 'last_name', 'label' => 'Last Name'],
          ['key' => 'phone', 'label' => 'Phone'],
          ['key' => 'email', 'label' => 'Email'],
          ['key' => 'province_id', 'label' => 'province_id'],
          ['key' => 'province_name', 'label' => 'province_name'],
          ['key' => 'city_id', 'label' => 'city_id'],
          ['key' => 'city_name', 'label' => 'city_name'],
          ['key' => 'address', 'label' => 'address'],
          ['key' => 'postal_code', 'label' => 'postal_code'],
          ['key' => 'is_activated', 'label' => 'Activate'],
          ['key' => 'created_at', 'label' => 'Date', 'format' => ['date', 'd/m/Y'], 'sortable' => true],
      ];
  }
  
  public function search(string $value = '')
  {
      $selectedOption = Customer::where('id', $this->customer_searchable_id)->get();

      $this->customersSearchable = Customer::query()
          ->where('first_name', 'like', "%$value%")
          ->take(5)
          ->orderBy('first_name')
          ->get()
          ->merge($selectedOption);     

      $this->customersMultiSearchable = Customer::query()
          ->where('first_name', 'like', "%$value%")
          ->take(5)
          ->orderBy('first_name')
          ->get()
          ->merge($selectedOption);     
  }

  public function searchMulti($value)
  {
    $selectedOption = Customer::where('id', $this->customer_searchable_id)->get();

    
    $this->customersMultiSearchable = Customer::query()
    ->where('first_name', 'like', "%$value%")
    ->take(5)
    ->orderBy('first_name')
    ->get()
    ->merge($selectedOption);
  }

  public function clear(): void
  {
      $this->reset();
      $this->success('Filters cleared.', position: 'toast-bottom');
  }




  #[\Livewire\Attributes\Locked]
  private string $basePageName = 'customer';

}
