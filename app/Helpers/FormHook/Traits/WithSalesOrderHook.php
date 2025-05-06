<?php

namespace App\Helpers\FormHook\Traits;

use App\Livewire\Pages\Admin\Sales\SalesOrderResources\Forms\SalesOrderForm;
use App\Livewire\Pages\Admin\Sales\SalesOrderResources\Forms\SalesOrderDetailForm;
use Illuminate\Support\Collection;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Product;
use App\Models\SalesOrderDetail;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;

trait WithSalesOrderHook
{


    #[\Livewire\Attributes\Locked]
    public string $id = '';

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

    public SalesOrderForm $masterForm;
    public SalesOrderDetailForm $masterFormDetail;

    public Collection $customersSearchable;
    public Collection $employeesSearchable;
    public Collection $productsSearchable;

    public function openModal()
    {
        return $this->modalDetail = true;
    }

    public function closeModal()
    {
        return $this->modalDetail = false;
    }

    public function searchCustomer(string $value = '')
    {
        $this->validatedForm = $this->validate(
            $this->masterForm->rules(),
            [],
            $this->masterForm->attributes()
        )['masterForm'];

        $selectedOption = Customer::where('id', $this->validatedForm['customer_id'])->get();

        $this->customersSearchable = Customer::query()
            ->select([
                'customers.id',
                DB::raw("CONCAT(customers.first_name, ' ', customers.last_name) as name"),
            ])->where('customers.first_name', 'like', "%$value%")
            ->orderBy('customers.created_at')
            ->get()
            ->merge($selectedOption);
    }

    public function searchEmployee(string $value = '')
    {
        $this->validatedForm = $this->validate(
            $this->masterForm->rules(),
            [],
            $this->masterForm->attributes()
        )['masterForm'];

        $selectedOption = Employee::where('id', $this->validatedForm['employee_id'])->get();

        $this->employeesSearchable = Employee::query()
            ->select([
                'employees.id',
                'employees.name',
            ])->where('employees.name', 'like', "%$value%")
            ->orderBy('employees.created_at')
            ->get()
            ->merge($selectedOption);
    }

    public function searchProduct(string $value = '')
    {
        $this->validatedForm = $this->validate(
            $this->masterFormDetail->rules(),
            [],
            $this->masterFormDetail->attributes()
        )['masterFormDetail'];

        $selectedOption = Product::where('id', $this->validatedForm['id'])->get();

        $this->productsSearchable = Product::query()
            ->select([
                'products.*',
            ])->where('products.name', 'like', "%$value%")
            ->orderBy('products.created_at')
            ->get()
            ->merge($selectedOption);
    }



    public function createDetail()
    {
        $this->masterFormDetail->selling_price = 0;
        $this->masterFormDetail->qty = 0;
        // $this->masterFormDetail->reset();
        $this->openModal();
    }

    public function storeDetail()
    {
        if ($this->detailId) {
            $this->editDetail($this->detailId);
        }

        $this->validatedFormDetail = $this->validate(
            $this->masterFormDetail->rules(),
            [],
            $this->masterFormDetail->attributes()
        )['masterFormDetail'];


        try {

            $this->validatedFormDetail['created_by'] = 'admin';
            $this->validatedFormDetail['updated_by'] = 'admin';

            $this->validatedFormDetail['created_at'] = now();
            $this->validatedFormDetail['updated_at'] = now();

            $this->details[] = $this->validatedFormDetail;

            $this->closeModal();


            $this->success('Data has been stored');
        } catch (\Throwable $th) {
            \Log::error('Data failed to store: ' . $th->getMessage());
            $this->error('Data failed to store');
        }
    }

    public function editDetail($detailId)
    {
        $this->detailId = $detailId;

        $detail = $this->detailModel::where('id', $detailId)->first();
        if ($detail) {
            $this->masterFormDetail->reset();
            $this->masterFormDetail->fill($detail);
            $this->openModal();
        } else {
            $this->error('Data not found');

            session()->flash('error', 'Detail tidak ditemukan.');
        }
    }

    public function updateDetail()
    {

        $validatedForm = $this->validate(
            $this->masterFormDetail->rules(),
            [],
            $this->masterFormDetail->attributes()
        )['masterFormDetail'];

        $masterData = $this->detailModel::findOrFail($this->detailId);

        try {

            $validatedForm['updated_by'] = 'admin';

            $masterData->update($validatedForm);

            \Illuminate\Support\Facades\DB::commit();

            $this->success('Data has been updated');
        } catch (\Throwable $e) {
            \Log::error('Data failed : ' . $e->getMessage());

            \Illuminate\Support\Facades\DB::rollBack();
            $this->error('Data failed to update');
        }


        $this->modalDetail = false;
    }

    public function deleteDetail($detailId)
    {
        $this->detailId = $detailId;
        $detail = $this->detailModel::find($this->detailId);
        if (!$detail) {
            $this->error('Data failed to delete');
        }
        $detail->delete();
        $this->success('Data success to delete');
    }
}
