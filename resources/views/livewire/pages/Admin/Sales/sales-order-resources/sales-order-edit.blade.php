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


    <x-tabs wire:model="selectedTab" class="h-screen">
      <x-tab name="sales-order-tab" label="Sales Order" icon="o-users" class="h-screen">

        <x-form wire:submit="update" wire:confirm="Are you sure?">

          <input wire:model="masterForm.employee_id" value="masterForm.employee_id" label="Employee ID"
            placeholder="Employee ID" hidden />
          <input wire:model="masterForm.customer_id" value="masterForm.customer_id" label="Customer ID"
            placeholder="Customer ID" hidden />
          <x-input wire:model="masterForm.first_name" label="First Name" placeholder="First Name" />
          <x-input wire:model="masterForm.last_name" label="Last Name" placeholder="Last Name" />
          <x-input wire:model="masterForm.date" label="Date" placeholder="Date" />
          <x-input wire:model="masterForm.number" label="Number" placeholder="Number" />
          <x-input wire:model="masterForm.employee_name" label="Employee Name" placeholder="First Name" />
          <x-input wire:model="masterForm.status" label="Status" placeholder="Status" />

          <x-input wire:model="masterForm.fraud_status" label="Fraud Status" placeholder="Fraud Status" />


          <div class="mb-3">
            <x-choices-offline wire:model="masterForm.is_activated" label="Is Activated" :options="[['id' => 0, 'name' => 'Inactive'], ['id' => 1, 'name' => 'Active']]" single
              searchable />
          </div>

          <div class="text-center mt-3">
            <x-errors class="text-white mb-3" />
            <x-button type="submit" label="Update" class="btn-success btn-sm text-white" />
          </div>
        </x-form>

      </x-tab>
      <x-tab name="sales-order-detail-tab" label="Sales Order Detail" icon="o-sparkles">
        <livewire:pages.admin.sales.sales-order-detail-resources.sales-order-detail-list />
      </x-tab>
    </x-tabs>



  </x-card>



</div>
