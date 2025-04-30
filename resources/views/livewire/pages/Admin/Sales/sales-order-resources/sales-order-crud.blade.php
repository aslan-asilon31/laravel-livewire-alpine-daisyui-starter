<div>
  <x-list-menu :title="$title" :url="$url" shadow separator class="" />



  @php
    $masterForm->is_processed === 1 ? 'ya' : 'no';
  @endphp

  <x-form wire:submit="{{ $id ? 'update' : 'store' }}" wire:confirm="Are you sure?">

    <x-input wire:model="masterForm.first_name" label="First Name" placeholder="First Name" :readonly="$isReadonly" />
    <x-input wire:model="masterForm.last_name" label="Last Name" placeholder="Last Name" :readonly="$isReadonly" />
    <x-input wire:model="masterForm.date" label="Date" placeholder="Date" :readonly="$isReadonly" />
    <x-input wire:model="masterForm.number" label="Number" placeholder="Number" :readonly="$isReadonly" />
    <x-input wire:model="masterForm.status" label="Status" placeholder="Status" :readonly="$isReadonly" />
    <x-input wire:model="masterForm.fraud_status" label="Fraud Status" placeholder="Fraud Status" :readonly="$isReadonly" />


    <div class="mb-3">
      <x-choices-offline wire:model="masterForm.is_activated" label="Is Activated" :options="[['id' => 0, 'name' => 'Inactive'], ['id' => 1, 'name' => 'Active']]" single searchable
        :readonly="$isReadonly" />
    </div>

    @if (!$isReadonly)
      <div class="text-center mt-3">
        <x-errors class="text-white mb-3" />
        <x-button type="submit" :label="$id ? 'Update' : 'Store'" class="btn-success btn-sm text-white" />
      </div>
    @endif
  </x-form>


</div>
