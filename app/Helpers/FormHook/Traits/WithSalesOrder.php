<?php

namespace App\Helpers\FormHook\Traits;


use Illuminate\Support\Collection;

use App\Livewire\Pages\Admin\Sales\SalesOrderResources\Forms\SalesOrderForm;
use App\Livewire\Pages\Admin\Sales\SalesOrderResources\Forms\SalesOrderDetailForm;


trait WithSalesOrder
{

    public SalesOrderForm $headerForm;
    public SalesOrderDetailForm $detailForm;

    public int $detailIndex;


    #[\Livewire\Attributes\Locked]
    public string $readonly = '';

    #[\Livewire\Attributes\Locked]
    public bool $isReadonly = false;

    #[\Livewire\Attributes\Locked]
    public bool $isDisabled = false;

    #[\Livewire\Attributes\Locked]
    public array $options = [];

    #[\Livewire\Attributes\Locked]
    protected $headerModel = \App\Models\SalesOrder::class;
    protected $detailModel = \App\Models\SalesOrderDetail::class;

    public array $validatedForm = [];
    public array $validatedFormDetail = [];
    public bool $modalDetail = false;
    public array $details = [];
    public  $detailId = null;
    public array $headers = [];




    public Collection $customersSearchable;
    public Collection $employeesSearchable;
    public Collection $productsSearchable;

    public function openModal()
    {
        $this->detailForm->reset();
        return $this->modalDetail = true;
    }

    public function closeModal()
    {
        return $this->modalDetail = false;
        $this->detailForm->reset();
    }


    public function createDetail()
    {
        $this->detailForm->selling_price = 0;
        $this->detailForm->qty = 0;
        $this->detailForm->product_name = '';
        $this->openModal();
    }

    public function storeDetail()
    {
        $this->detailForm->id = str()->orderedUuid()->toString();
        $this->detailForm->sales_order_id = str()->orderedUuid()->toString();
        $this->detailForm->product_name = $this->getSelectedProductName();
        $this->validatedDetailForm = $this->validate(
            $this->detailForm->rules(),
            [],
            $this->detailForm->attributes()
        )['detailForm'];

        $this->details[] =  $this->validatedDetailForm;
        $this->modalDetail = false;
        $this->reset('detailForm');
        $this->success('Sales Order Detail Created.');
    }

    public function editDetail($detailIndex)
    {
        $detailData = $this->details[$detailIndex];
        $this->detailForm->fill($detailData);
        $this->detailId = $this->detailForm->id;

        $this->detailIndex = $detailIndex;
        return $this->modalDetail = true;
    }

    public function updateDetail()
    {
        $validatedDetailForm = $this->validate(
            $this->detailForm->rules(),
            [],
            $this->detailForm->attributes()
        )['detailForm'];

        $this->details[$this->detailIndex] = $this->detailForm->toArray();

        $this->reset(['detailForm', 'detailIndex']);
        $this->modalDetail = false;
        $this->success('Sales Order Detail Updated.');
    }

    public function deleteDetail($detailIndex)
    {
        unset($this->details[$detailIndex]);
        $this->details = array_values($this->details);
        $this->success('Sales Order Detail Deleted.');
    }

    public function delete()
    {
        $headerModel = $this->headerModel::findOrFail($this->id);
        try {
            $headerModel->delete();
            $this->success('Data has been deleted');
            $this->redirect('/sales-orders');
        } catch (\Throwable $th) {
            $this->error('Data failed to delete');
        }
    }


    // hook detail


    public function getSelectedProductName()
    {
        $productId = $this->detailForm->product_id ?? null;
        if (!$productId) {
            return null;
        }

        $product = \App\Models\Product::find($productId);

        return $product ? $product->name : null;
    }

    public function searchProduct(string $value = '')
    {
        $selectedOption = \App\Models\Product::where('id', $this->detailForm->product_id ?? null)->get();

        $this->productsSearchable = \App\Models\Product::query()
            ->where('name', 'like', "%$value%")
            ->orderBy('name')
            ->get()
            ->merge($selectedOption);
    }

    public function updatedDetailFormProductId($productId)
    {
        $product = \App\Models\Product::findOrFail($productId)->toArray();
        $this->detailForm->selling_price = $product['selling_price'];
        $this->detailForm->qty = 1;
    }


    // hook header
    public function searchEmployee(string $value = '')
    {
        $selectedOption = \App\Models\Employee::where('id', $this->headerForm->employee_id)->get();

        $this->employeesSearchable = \App\Models\Employee::query()
            ->where('name', 'like', "%$value%")
            ->orderBy('name')
            ->get()
            ->merge($selectedOption);
    }

    public function searchCustomer(string $value = '')
    {
        $selectedOption = \App\Models\Customer::where('id', $this->headerForm->customer_id)->get();
        $this->customersSearchable = \App\Models\Customer::query()
            ->where('first_name', 'like', "%$value%")
            ->orderBy('created_at')
            ->get()
            ->merge($selectedOption);
    }
    // ./hook header
}
