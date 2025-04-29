<?php

namespace App\Livewire\Pages\Admin\Contents\ProductResources\Forms;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class ProductForm extends Form
{
  public string|null $name = null;
  public TemporaryUploadedFile|string|null $image_url;
  public string|null $selling_price = null;
  public int|null $is_activated = null;


  public function rules(string|null $id = null): array
  {
    return [
      'masterForm.name' => 'nullable|string',
      'masterForm.image_url' => 'nullable|string',
      'masterForm.selling_price' => 'nullable|integer',
      'masterForm.is_activated' => 'nullable|integer',
    ];
  }

  public function attributes(): array
  {
    return [
      'masterForm.name' => 'Name',
      'masterForm.image_url' => 'Image URL',
      'masterForm.selling_price' => 'Selling Price',
      'masterForm.is_activated' => 'Is Activated',
    ];
  }
}
