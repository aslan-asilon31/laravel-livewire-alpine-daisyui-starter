<?php

namespace App\Livewire\Pages\Admin\Sales\SalesOrderDetailResources\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Validation\Rule;

class SalesOrderDetailForm extends Form
{
  public ?string $id;

  public ?string $name;
  public ?string $sales_order_id;
  public ?string $product_id;
  public int $selling_price;
  public int $qty;
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
      'masterForm.name' => ['nullable', 'string', 'max:255'],
      'masterForm.sales_order_id' => ['nullable', 'string', 'max:255'],
      'masterForm.product_id' => ['nullable', 'string', 'max:255'],
      'masterForm.selling_price' => ['nullable', 'integer'],
      'masterForm.qty' => ['nullable', 'integer'],
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
      'masterForm.name' => 'Name',
      'masterForm.sales_order_id' => 'Sales Order ID',
      'masterForm.product_id' => 'Product ID',
      'masterForm.selling_price' => 'Selling Price',
      'masterForm.qty' => 'Quantity',
      'masterForm.created_by' => 'Created By',
      'masterForm.updated_by' => 'Updated By',
      'masterForm.status' => 'Status',
      'masterForm.is_activated' => 'Is Activated',
    ];
  }
}
