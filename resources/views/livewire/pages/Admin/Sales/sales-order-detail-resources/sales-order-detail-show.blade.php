<div>
  <x-list-menu :title="$title" :url="$url" shadow separator class="" />


  <x-form wire:submit="{{ $id ? 'update' : 'store' }}" wire:confirm="Are you sure?">

    <x-input wire:model="masterForm.customer_id" label="" placeholder="" :readonly="true" hidden />
    <x-input wire:model="masterForm.employee_id" label="" placeholder="" :readonly="true" hidden />
    <x-input wire:model="masterForm.first_name" label="First Name" placeholder="First Name" :readonly="true" />
    <x-input wire:model="masterForm.last_name" label="Last Name" placeholder="Last Name" :readonly="true" />
    <x-input wire:model="masterForm.date" label="Date" placeholder="Date" :readonly="true" />
    <x-input wire:model="masterForm.number" label="Number" placeholder="Number" :readonly="true" />
    <x-input wire:model="masterForm.total_amount" label="Total amount" placeholder="total amount" :readonly="true" />
    <x-input wire:model="masterForm.status" label="Status" placeholder="Status" :readonly="true" />

    <x-input wire:model="masterForm.is_processed" label="is processed ?" placeholder="is processed"
      :readonly="true" />
    <x-input wire:model="masterForm.fraud_status" label="Fraud Status" placeholder="Fraud Status" :readonly="true" />


    <div class="mb-3">
      <x-choices-offline wire:model="masterForm.is_activated" label="Is Activated" :options="[['id' => 0, 'name' => 'Inactive'], ['id' => 1, 'name' => 'Active']]" single searchable
        :readonly="true" />
    </div>

  </x-form>


</div>
