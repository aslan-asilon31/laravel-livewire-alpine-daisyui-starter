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
  public ?string $number;
  public ?string $created_by = null;
  public ?string $updated_by = null;
  public ?string $status = "";
  public int $is_processed = 1;
  public int $is_activated = 1;


  public function rules()
  {
    return [
      'headerForm.customer_id' => ['required', 'string', 'max:255'],
      'headerForm.employee_id' => ['required', 'string', 'max:255'],
      'headerForm.date' => ['required', 'string', 'max:255'],
      'headerForm.number' => ['required', 'string', 'max:255'],
      'headerForm.created_by' => ['nullable', 'string', 'max:255'],
      'headerForm.updated_by' => ['nullable', 'string', 'max:255'],
      'headerForm.status' => ['required', 'string', 'max:255'],
      'headerForm.is_activated' => ['required', 'integer', Rule::in([0, 1])],


    ];
  }

  public function attributes()
  {
    return [
      'headerForm.employee_id' => 'Employee Id',
      'headerForm.customer_id' => 'Customer Id',
      'headerForm.date' => 'Date',
      'headerForm.number' => 'Number',
      'headerForm.created_by' => 'Created By',
      'headerForm.updated_by' => 'Updated By',
      'headerForm.status' => 'Status',
      'headerForm.is_activated' => 'Is Activated',

    ];
  }
}
