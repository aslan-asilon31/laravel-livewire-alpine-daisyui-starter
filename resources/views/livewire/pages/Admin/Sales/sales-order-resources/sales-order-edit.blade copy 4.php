<div>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

  <x-card :title="$title" shadow separator class="border shadow">

    <div class="grid grid-cols-2 mb-4">
      <div>

        <x-button label="List" link="{{ $url }}" class="btn-ghost btn-outline" />

      </div>
      <div class="text-right">
        <x-button label="Delete" wire:click="delete" wire:confirm="Apakah kamu yakin ingin menghapus data ini?"
          class="btn-ghost btn-outline text-red-500" />
      </div>
    </div>

    <x-form wire:submit="update" wire:confirm="Are you sure?">
      {{-- Hidden Inputs --}}
      <input wire:model="masterForm.employee_id" type="hidden" />
      <input wire:model="masterForm.customer_id" type="hidden" />

      {{-- 2-Column Grid Layout --}}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">


        <div class="mb-3">
          <x-select label="Customer" wire:model="masterForm.customer_id" :options="$this->customers()" option-label="name"
            option-value="id" icon="o-user" />
        </div>


        <div class="mb-3">
          <x-datepicker label="Date" wire:model="masterForm.date" icon="o-calendar" />
        </div>


        <div class="mb-3">
          <x-input wire:model="masterForm.number" label="Number" placeholder="Number" />
        </div>


        <div class="mb-3">
          <x-select label="Employee" wire:model="masterForm.employee_id" :options="$this->employees()" option-label="name"
            option-value="id" icon="o-user" />
        </div>


        <div class="mb-3">
          <x-select label="Status" wire:model="masterForm.status" :options="[
              ['id' => 1, 'name' => 'success'],
              ['id' => 2, 'name' => 'failed'],
              ['id' => 3, 'name' => 'settlement'],
          ]" option-label="name"
            option-value="id" icon="o-user" />
        </div>

        <div class="mb-3">
          <x-input wire:model="masterForm.fraud_status" label="Fraud Status" placeholder="Fraud Status" />
        </div>


        <div class="mb-3">
          <x-input label="Created By" wire:model="masterFormDetail.created_by" id="masterFormDetail.created_by"
            name="masterForm.created_by" placeholder="Created By" />
        </div>

        <div class="mb-3">
          <x-input label="Updated By" wire:model="masterForm.updated_by" id="masterForm.updated_by"
            name="masterForm.updated_by" placeholder="Updated By" />
        </div>

        <div class="mb-3">
          <x-datepicker label="Created At" wire:model="masterForm.created_at" :config="['dateFormat' => 'Y-m-d H:i:S', 'enableTime' => true, 'time_24hr' => true]" icon="o-calendar" />
        </div>

        <div class="mb-3">
          <x-datepicker label="Updated At" wire:model="masterForm.updated_at" :config="['dateFormat' => 'Y-m-d H:i:S', 'enableTime' => true, 'time_24hr' => true]" icon="o-calendar" />
        </div>


        <div class="mb-3">
          <x-choices-offline wire:model="masterForm.is_activated" label="Is Activated" :options="[['id' => 0, 'name' => 'Inactive'], ['id' => 1, 'name' => 'Active']]" single
            searchable />
        </div>
      </div>

      <div class="text-center mt-6">
        <x-errors class="text-white mb-3" />
        <x-button type="submit" label="Update" class="btn-success btn-sm text-white" />
      </div>

    </x-form>



    <x-header size="mt-8" separator />
    <x-header title="Sales Order Detail" size="text-xl" separator />

    <x-form wire:submit="updateSalesOrderDetail" wire:confirm="Are you sure?">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">


        <div class="mb-3">
          <x-select label="Product" wire:model="masterFormDetail.product_id" :options="$this->products()" option-label="name"
            option-value="id" icon="o-user" />
        </div>

        <div class="mb-3">
          <x-input label="Created By" wire:model="masterFormDetail.created_by" id="masterFormDetail.created_by"
            name="masterFormDetail.created_by" placeholder="Created By" />
        </div>

        <div class="mb-3">
          <x-input label="Selling Price" wire:model="masterFormDetail.selling_price" id="masterFormDetail.selling_price"
            name="masterFormDetail.selling_price" placeholder="Selling Price" />
        </div>

        <div class="mb-3">
          <x-input label="Quantity" wire:model="masterFormDetail.qty" id="masterFormDetail.qty"
            name="masterFormDetail.qty" placeholder="Quantity" />
        </div>

        <div class="mb-3">
          <x-input label="Created By" wire:model="masterFormDetail.created_by" id="masterFormDetail.created_by"
            name="masterFormDetail.created_by" placeholder="Created By" />
        </div>

        <div class="mb-3">
          <x-input label="Updated By" wire:model="masterFormDetail.updated_by" id="masterFormDetail.updated_by"
            name="masterFormDetail.updated_by" placeholder="Updated By" />
        </div>

        <div class="mb-3">
          <x-datepicker label="Updated At" wire:model="masterFormDetail.created_at" icon="o-calendar" />
        </div>

        <div class="mb-3">
          <x-datepicker label="Updated At" wire:model="masterFormDetail.updated_at" icon="o-calendar" />

        </div>

        <div class="mb-3">
          <x-choices-offline wire:model="masterFormDetail.is_activated" label="Is Activated" :options="[['id' => 0, 'name' => 'Inactive'], ['id' => 1, 'name' => 'Active']]" single
            searchable />
        </div>

      </div>
      <div class="text-center mt-3">
        <x-errors class="text-white mb-3" />
        <x-button type="submit" :label="$id ? 'Update' : 'Store'" class="btn-success btn-sm text-white" />
      </div>
    </x-form>



  </x-card>



</div>
