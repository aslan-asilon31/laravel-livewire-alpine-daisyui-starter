<?php

namespace App\Livewire\Pages\Admin\Sales\SalesOrderResources\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Validation\Rule;

class SalesOrderForm extends Form
{

  public ?string $employee_id;
  public ?string $customer_id;
  public ?string $date;
  public ?string $created_by = null;
  public ?string $updated_by = null;
  public ?string $status = null;
  public int $is_processed = 1;
  public int $is_activated = 1;


  public function rules()
  {
    return [
      'masterForm.customer_id' => ['nullable', 'string', 'max:255'],
      'masterForm.employee_id' => ['nullable', 'string', 'max:255'],
      'masterForm.date' => ['nullable', 'string', 'max:255'],
      'masterForm.created_by' => ['nullable', 'string', 'max:255'],
      'masterForm.updated_by' => ['nullable', 'string', 'max:255'],
      'masterForm.status' => ['nullable', 'string', 'max:255'],
      'masterForm.is_activated' => ['nullable', 'integer', Rule::in([0, 1])],


    ];
  }

  public function attributes()
  {
    return [
      'masterForm.employee_id' => 'Employee Id',
      'masterForm.customer_id' => 'Customer Id',
      'masterForm.created_by' => 'Created By',
      'masterForm.updated_by' => 'Updated By',
      'masterForm.status' => 'Status',
      'masterForm.is_activated' => 'Is Activated',

    ];
  }
}
