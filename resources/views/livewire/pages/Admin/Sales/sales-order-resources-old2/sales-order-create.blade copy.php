<div>
  <x-list-menu :title="$title" :url="$url" shadow separator class="" />

  <x-form wire:submit="store" wire:confirm="Are you sure?">

    <x-input wire:model="masterForm.first_name" label="First Name" placeholder="First Name" />
    <x-input wire:model="masterForm.last_name" label="Last Name" placeholder="Last Name" />
    <x-input wire:model="masterForm.date" label="Date" placeholder="Date" />
    <x-input wire:model="masterForm.number" label="Number" placeholder="Number" />
    <x-input wire:model="masterForm.status" label="Status" placeholder="Status" />
    <x-input wire:model="masterForm.fraud_status" label="Fraud Status" placeholder="Fraud Status" />

    <div class="mb-3">
      <x-choices-offline wire:model="masterForm.is_activated" label="Is Activated" :options="[['id' => 0, 'name' => 'Inactive'], ['id' => 1, 'name' => 'Active']]" single
        searchable />
    </div>

    <div class="text-center mt-3">
      <x-errors class="text-white mb-3" />
      <x-button type="submit" label="Store" class="btn-success btn-sm text-white" />
    </div>
  </x-form>


</div>
