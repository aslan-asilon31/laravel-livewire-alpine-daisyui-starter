<?php

namespace App\Livewire\Pages\Admin\Sales\CustomerResources;

use App\Livewire\Pages\Admin\Sales\CustomerResources\Forms\CustomerForm;
use Livewire\Component;
use App\Models\Page;
use App\Models\Customer;

class CustomerCreate extends Component
{
  public function render()
  {
    return view('livewire.pages.admin.sales.customer-resources.customer-create')
      ->title($this->title);
  }

  use \Livewire\WithFileUploads;
  use \App\Helpers\ImageUpload\Traits\WithImageUpload;
  use \App\Helpers\Permission\Traits\WithPermission;
  use \Mary\Traits\Toast;

  #[\Livewire\Attributes\Locked]
  private string $basePageName = 'customer';

  #[\Livewire\Attributes\Locked]
  public string $title = 'Customer';

  #[\Livewire\Attributes\Locked]
  public string $url = '/customers';

  #[\Livewire\Attributes\Locked]
  private string $baseImageName = 'customer_image';

  #[\Livewire\Attributes\Locked]
  public string $id = '';

  #[\Livewire\Attributes\Locked]
  public string $readonly = '';

  #[\Livewire\Attributes\Locked]
  public bool $isReadonly = false;

  #[\Livewire\Attributes\Locked]
  public bool $isDisabled = false;

  #[\Livewire\Attributes\Locked]
  public array $options = [];

  #[\Livewire\Attributes\Locked]
  protected $masterModel = \App\Models\Customer::class;

  public CustomerForm $masterForm;

  public function mount() {}

  public function create()
  {

    $this->masterForm->reset();
  }

  public function store()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];

    \Illuminate\Support\Facades\DB::beginTransaction();
    try {

      $validatedForm['created_by'] = 'admin';
      $validatedForm['updated_by'] = 'admin';

      $this->masterModel::create($validatedForm);
      \Illuminate\Support\Facades\DB::commit();

      $this->create();
      $this->success('Data has been stored');
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      \Log::error('Data failed to store: ' . $th->getMessage());
      $this->error('Data failed to store');
    }
  }
}
