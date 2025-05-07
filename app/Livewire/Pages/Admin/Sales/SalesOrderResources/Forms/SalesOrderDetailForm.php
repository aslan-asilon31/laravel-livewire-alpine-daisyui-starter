<?php

namespace App\Livewire\Pages\Admin\Sales\SalesOrderResources\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Validation\Rule;

class SalesOrderDetailForm extends Form
{
  public ?string $id;
  public ?string $sales_order_id;
  public ?string $product_id;
  public ?string $product_name;
  public int $selling_price = 0;
  public int $qty = 0;
  public ?string $created_by = null;
  public ?string $updated_by = null;
  public int $is_activated = 1;

  public function rules()
  {
    return [
      'detailForm.id' => ['required', 'string', 'max:255'],
      'detailForm.sales_order_id' => ['required', 'string', 'max:255'],
      'detailForm.product_id' => ['required', 'string', 'max:255'],
      'detailForm.product_name' => ['nullable', 'string', 'max:255'],
      'detailForm.selling_price' => ['required', 'integer'],
      'detailForm.qty' => ['required', 'integer'],
      'detailForm.created_by' => ['nullable', 'string', 'max:255'],
      'detailForm.updated_by' => ['nullable', 'string', 'max:255'],
      'detailForm.is_activated' => ['required', 'integer', Rule::in([0, 1])],
    ];
  }

  public function attributes()
  {
    return [
      'detailForm.id' => 'Id',
      'detailForm.sales_order_id' => 'Sales Order ID',
      'detailForm.product_id' => 'Product ID',
      'detailForm.product_name' => 'Product Name',
      'detailForm.selling_price' => 'Selling Price',
      'detailForm.qty' => 'Quantity',
      'detailForm.created_by' => 'Created By',
      'detailForm.updated_by' => 'Updated By',
      'detailForm.is_activated' => 'Is Activated',
    ];
  }
}
