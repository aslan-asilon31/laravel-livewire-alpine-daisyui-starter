<?php

namespace App\Livewire\Pages\Admin\Sales\SalesOrderResources\Forms;

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
  public int $selling_price = 0;
  public int $qty = 0;
  public ?string $created_by = null;
  public ?string $updated_by = null;
  public ?string $fraud_status = null;
  public int $is_processed = 1;
  public int $is_activated = 1;

  public function rules()
  {
    return [
      'masterFormDetail.id' => ['nullable', 'string', 'max:255'],
      'masterFormDetail.sales_order_id' => ['nullable', 'string', 'max:255'],
      'masterFormDetail.product_id' => ['nullable', 'string', 'max:255'],
      'masterFormDetail.selling_price' => ['nullable', 'integer'],
      'masterFormDetail.qty' => ['nullable', 'integer'],
      'masterFormDetail.created_by' => ['nullable', 'string', 'max:255'],
      'masterFormDetail.updated_by' => ['nullable', 'string', 'max:255'],
      'masterFormDetail.is_activated' => ['nullable', 'integer', Rule::in([0, 1])],
    ];
  }

  public function attributes()
  {
    return [
      'masterFormDetail.id' => 'Id',
      'masterFormDetail.name' => 'Name',
      'masterFormDetail.sales_order_id' => 'Sales Order ID',
      'masterFormDetail.product_id' => 'Product ID',
      'masterFormDetail.selling_price' => 'Selling Price',
      'masterFormDetail.qty' => 'Quantity',
      'masterFormDetail.created_by' => 'Created By',
      'masterFormDetail.updated_by' => 'Updated By',
      'masterFormDetail.is_activated' => 'Is Activated',
    ];
  }
}
