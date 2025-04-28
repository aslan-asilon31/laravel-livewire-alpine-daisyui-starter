<?php

namespace App\Livewire\Pages\Admin\Contents\ProductResources\Forms;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class ProductForm extends Form
{
  public string|null $name = null;

  public function rules(string|null $id = null): array
  {
    return [
      'masterForm.name' => 'required|string',
    ];
  }

  public function attributes(): array
  {
    return [
      'masterForm.name' => 'Name',
    ];
  }
}
