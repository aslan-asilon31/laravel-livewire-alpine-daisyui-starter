<?php

namespace App\Livewire\Pages\Admin\MarketplaceResources\Forms;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class MarketplaceForm extends Form
{
  public string|null $name = null;
  public string|null $url = null;
  public float|null $ordinal = 0;
  public TemporaryUploadedFile|string|null $image_url = null;
  public int|null $is_activated = 1;

  public function rules(string|null $id = null): array
  {
    return [
      'masterForm.name' => 'required|string',
      'masterForm.url' => 'required|string',
      'masterForm.ordinal' => 'required|numeric|min:0',
      'masterForm.image_url' => [
        'nullable',
        new \App\Rules\StringOrImageRule,
      ],
      'masterForm.is_activated' => 'required|bool',
    ];
  }

  public function attributes(): array
  {
    return [
      'masterForm.name' => 'Name',
      'masterForm.url' => 'Url',
      'masterForm.ordinal' => 'Ordinal',
      'masterForm.image_url' => 'Image',
      'masterForm.is_activated' => 'Is Activated',
    ];
  }
}
