<?php

namespace App\Livewire\Pages\Admin\Sales\SalesOrderResources\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Validation\Rule;

class SalesOrderForm extends Form
{
  public ?string $id;

  public ?string $employee_id;
  public ?string $customer_id;
  public ?string $employee_name;
  public ?string $first_name;
  public ?string $last_name;
  public ?string $phone;
  public ?string $date = null;
  public ?string $number = null;
  public ?string $note = null;
  public ?string $created_by = null;
  public ?string $updated_by = null;
  public ?string $status = null;
  public ?string $fraud_status = null;
  public int $is_processed = 1;
  public int $is_activated = 1;


  public function rules()
  {
    return [
      'masterForm.id' => ['nullable', 'string', 'max:255'],
      'masterForm.customer_id' => ['nullable', 'string', 'max:255'],
      'masterForm.employee_id' => ['nullable', 'string', 'max:255'],
      'masterForm.employee_name' => ['nullable', 'string', 'max:255'],
      'masterForm.first_name' => ['nullable', 'string', 'max:255'],
      'masterForm.last_name' => ['nullable', 'string', 'max:255'],
      'masterForm.phone' => ['nullable', 'string', 'max:255'],
      'masterForm.date' => ['nullable', 'string', 'max:255'],
      'masterForm.number' => ['nullable', 'string', 'max:255'],
      'masterForm.created_by' => ['nullable', 'string', 'max:255'],
      'masterForm.updated_by' => ['nullable', 'string', 'max:255'],
      'masterForm.status' => ['nullable', 'string', 'max:255'],
      'masterForm.is_activated' => ['nullable', 'integer', Rule::in([0, 1])],


    ];
  }

  public function attributes()
  {
    return [
      'masterForm.id' => 'Id',
      'masterForm.employee_id' => 'Employee Id',
      'masterForm.customer_id' => 'Customer Id',
      'masterForm.employee_name' => 'Employee Awal',
      'masterForm.first_name' => 'Nama Awal',
      'masterForm.last_name' => 'Nama Akhir',
      'masterForm.phone' => 'Phone',
      'masterForm.date' => 'Date',
      'masterForm.number' => 'Number',
      'masterForm.created_by' => 'Created By',
      'masterForm.updated_by' => 'Updated By',
      'masterForm.status' => 'Status',
      'masterForm.is_activated' => 'Is Activated',

    ];
  }
}
