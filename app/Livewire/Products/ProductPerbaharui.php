<?php

namespace App\Livewire\Products;

use App\Livewire\Product\Forms\ProductForm;
use Livewire\Component;
use Livewire\Attributes\On;

class ProductPerbaharui extends Component
{

  public function render()
  {
    return view('livewire.product.product-perbaharui')
      ->title($this->title);
  }

  use \Livewire\WithFileUploads;
  use \Mary\Traits\Toast;
  use \App\Helpers\FormHook\Traits\aksesOpsi;

  #[\Livewire\Attributes\Locked]
  public string $title = 'barang';

  #[\Livewire\Attributes\Locked]
  public string $url = '/barang';

  #[\Livewire\Attributes\Locked]
  private string $baseFolderName = '/files/images/barang';

  #[\Livewire\Attributes\Locked]
  public string $id = '';

  #[\Livewire\Attributes\Locked]
  public string $hanyalihat = '';

  #[\Livewire\Attributes\Locked]
  public bool $isReadonly = false;

  #[\Livewire\Attributes\Locked]
  public bool $isDisabled = false;

  #[\Livewire\Attributes\Locked]
  public array $options = [];

  #[\Livewire\Attributes\Locked]
  protected $masterModel = \App\Models\Product::class;

  #[\Livewire\Attributes\Locked]
  public array $optionStatus = [];
  public array $productsSend = [];
  public array $products = [];

  public ProductForm $masterForm;

  public function mount()
  {
    if ($this->id && $this->hanyalihat) {
      $this->title .= ' (Lihat)';
      $this->lihat();
    } else if ($this->id) {
      $this->title .= ' (Edit)';
      $this->edit();
    } else {
      $this->title .= ' (Buat)';
      $this->buat();
    }

    $this->initialize();
  }

  public function initialize() {}

  #[On('send-to-livewire')]
  public function updatedData(array $products)
  {
    $this->productsSend = $products;
  }


  public function buat()
  {
    $this->optionStatus = $this->aksesStatusOption();

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

      $validatedForm['dibuat_oleh'] = \Illuminate\Support\Facades\Auth::guard('pegawai')->user()->nama;
      $validatedForm['diupdate_oleh'] = \Illuminate\Support\Facades\Auth::guard('pegawai')->user()->nama;

      $this->masterModel::create($validatedForm);
      \Illuminate\Support\Facades\DB::commit();
      $this->redirect('/barang', true);
      $this->success('Data berhasil disimpan');
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      \Log::error('Data gagal disimpan: ' . $th->getMessage());

      $this->error('Data gagal disimpan');
    }
  }

  public function lihat()
  {
    dd('stop');
    $this->isReadonly = true;
    $this->isDisabled = true;
    $masterData = $this->masterModel::findOrFail($this->id);
    $this->masterForm->fill($masterData);
  }

  public function edit()
  {

    dd($this->productsSend);

    $this->optionStatus = $this->aksesStatusOption();

    $this->isReadonly = false;
    $this->isDisabled = false;
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

    try {

      $validatedForm['diupdate_oleh'] = \Illuminate\Support\Facades\Auth::guard('pegawai')->user()->nama ?? null;

      $masterData->update($validatedForm);
      $this->redirect('/barang', true);

      $this->success('Data berhasil diupdate');
    } catch (\Throwable $e) {
      \Log::error('Data gagal diupdate : ' . $e->getMessage());

      \Illuminate\Support\Facades\DB::rollBack();
      $this->error('Data gagal di update');
    }
  }

  public function delete()
  {
    $masterData = $this->masterModel::findOrFail($this->id);

    \Illuminate\Support\Facades\DB::beginTransaction();
    try {

      $masterData->delete();
      \Illuminate\Support\Facades\DB::commit();
      $this->redirect('/barang', true);

      $this->success('Data berhasil dihapus');
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      $this->error('Data gagal dihapus');
    }
  }
}
