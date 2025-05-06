<?php

namespace App\Livewire\Pages\Admin\Sales\SalesOrderResources\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Validation\Rule;

class SalesOrderForm extends Form
{
  public ?string $id;
  public ?string $employee_id = null;
  public ?string $customer_id = null;
  public int $is_activated = 1;

  public function rules()
  {
    return [
      'masterForm.id' => ['nullable', 'string', 'max:255'],
      'masterForm.employee_id' => ['nullable', 'string', 'max:255'],
      'masterForm.customer_id' => ['nullable', 'string', 'max:255'],
      'masterForm.is_activated' => ['nullable', 'integer', Rule::in([0, 1])],
    ];
  }

  public function attributes()
  {
    return [
      'masterForm.id' => 'Id',
      'masterForm.employee_id' => 'Employee ID',
      'masterForm.customer_id' => 'Customer ID',
      'masterForm.is_activated' => 'Is Activated',
    ];
  }
}
