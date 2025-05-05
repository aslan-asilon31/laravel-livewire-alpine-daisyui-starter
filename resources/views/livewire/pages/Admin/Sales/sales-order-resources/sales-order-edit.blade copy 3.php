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

        <x-select label="Customer" wire:model="masterForm.customer_id" :options="$this->customers()" option-label="name"
          option-value="id" icon="o-user" />

        <x-datepicker label="Date" wire:model="masterForm.date" icon="o-calendar" />

        <x-input wire:model="masterForm.number" label="Number" placeholder="Number" />

        <x-select label="Employee" wire:model="masterForm.employee_id" :options="$this->employees()" option-label="name"
          option-value="id" icon="o-user" />

        <x-select label="Status" wire:model="masterForm.status" :options="[
            ['id' => 1, 'name' => 'success'],
            ['id' => 2, 'name' => 'failed'],
            ['id' => 3, 'name' => 'settlement'],
        ]" option-label="name" option-value="id"
          icon="o-user" />

        <x-input wire:model="masterForm.fraud_status" label="Fraud Status" placeholder="Fraud Status" />

        <x-choices-offline wire:model="masterForm.is_activated" label="Is Activated" :options="[['id' => 0, 'name' => 'Inactive'], ['id' => 1, 'name' => 'Active']]" single
          searchable />
      </div>

      <div class="text-center mt-6">
        <x-errors class="text-white mb-3" />
        <x-button type="submit" label="Update" class="btn-success btn-sm text-white" />
      </div>

    </x-form>



    <x-header size="mt-8" separator />
    <x-header title="Sales Order Detail" size="text-xl" separator />

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <livewire.pages.admin.sales.sales-order-detail-resources.sales-order-detail-edit />
    </div>



  </x-card>



</div>
