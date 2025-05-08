<div>

  <x-list-menu :title="$title" :url="$url" :id="$id" shadow class="" />


  <x-form wire:submit="{{ $id ? 'update' : 'store' }}" wire:confirm="Are you sure?">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

      <div class="mb-3">
        <x-input label="First Name" wire:model.blur="masterForm.first_name" id="masterForm.first_name"
          name="masterForm.first_name" placeholder="First Name" />
      </div>

      <div class="mb-3">
        <x-input label="Last Name" wire:model.blur="masterForm.last_name" id="masterForm.last_name"
          name="masterForm.last_name" placeholder="Last Name" />
      </div>

      <div class="mb-3">
        <x-input label="Email" wire:model.blur="masterForm.email" id="masterForm.email" name="masterForm.email"
          placeholder="Email" />
      </div>

      <div class="mb-3">
        <x-input label="Phone" wire:model.blur="masterForm.phone" id="masterForm.phone" name="masterForm.phone"
          placeholder="Phone" />
      </div>

      <div class="mb-3">
        <x-choices-offline wire:model="masterForm.is_activated" label="Is Activated" :options="[['id' => 0, 'name' => 'Inactive'], ['id' => 1, 'name' => 'Active']]" single
          searchable />
      </div>

      <div class="text-center mt-3">
        <x-errors class="text-white mb-3" />
        <x-button type="submit" :label="$id ? 'Update' : 'Store'" class="btn-success btn-sm text-white" />
      </div>
    </div>
  </x-form>


</div>
