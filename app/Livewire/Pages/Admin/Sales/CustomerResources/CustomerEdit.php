<?php

namespace App\Livewire\Pages\Admin\Sales\CustomerResources;

use App\Livewire\Pages\Admin\Sales\CustomerResources\Forms\CustomerForm;
use Livewire\Component;
use App\Models\Page;
use App\Models\Customer;
use \Livewire\WithFileUploads;
use \App\Helpers\ImageUpload\Traits\WithImageUpload;
use \Mary\Traits\Toast;
use Livewire\WithPagination;

class CustomerEdit extends Component
{

  use Toast;
  use WithPagination;

  public function render()
  {
    return view('livewire.pages.admin.sales.customer-resources.customer-edit')
      ->title($this->title);
  }

  #[\Livewire\Attributes\Locked]
  private string $basePageName = 'customer';

  #[\Livewire\Attributes\Locked]
  public string $title = 'Customer ';

  #[\Livewire\Attributes\Locked]
  public string $url = '/customers';


  #[\Livewire\Attributes\Locked]
  public string $id = '';


  #[\Livewire\Attributes\Locked]
  public array $options = [];

  #[\Livewire\Attributes\Locked]
  protected $masterModel = \App\Models\Customer::class;

  public CustomerForm $masterForm;

  public function mount()
  {
    $masterData = $this->masterModel::findOrFail($this->id);
    $this->masterForm->fill($masterData);
  }

  public function update()
  {

    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];


    $masterData = $this->masterModel::findOrFail($this->id);

    \Illuminate\Support\Facades\DB::beginTransaction();
    try {

      $validatedForm['updated_by'] = 'admin';


      $masterData->update($validatedForm);

      \Illuminate\Support\Facades\DB::commit();

      $this->success('Data has been updated');
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      $this->error('Data failed to update');
    }
  }

  public function delete()
  {
    $masterData = $this->masterModel::findOrFail($this->id);
    \Illuminate\Support\Facades\DB::beginTransaction();
    try {
      $masterData->delete();
      \Illuminate\Support\Facades\DB::commit();

      $this->success('Data has been deleted');
      $this->redirect('/customers', true);
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      $this->error('Data failed to delete');
    }
  }
}
