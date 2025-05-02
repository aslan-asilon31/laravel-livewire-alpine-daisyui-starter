<div>

  <x-list-menu :title="$title" :url="$url" :id="$id" shadow class="" />

  <x-form wire:submit="update" wire:confirm="Are you sure?">

    <div class="mb-3">
      <x-input label="First Name" wire:model.blur="masterForm.name" id="masterForm.name" name="masterForm.name"
        placeholder="Name" />
    </div>

    <div class="mb-3">
      <x-input label="Sales Order ID" wire:model.blur="masterForm.sales_order_id" id="masterForm.sales_order_id"
        name="masterForm.sales_order_id" placeholder="Sales Order ID" />
    </div>

    <div class="mb-3">
      <x-input label="Product ID" wire:model.blur="masterForm.product_id" id="masterForm.product_id"
        name="masterForm.product_id" placeholder="Product ID" />
    </div>

    <div class="mb-3">
      <x-input label="Created By" wire:model.blur="masterForm.created_by" id="masterForm.created_by"
        name="masterForm.created_by" placeholder="Created By" />
    </div>

    <div class="mb-3">
      <x-input label="Updated By" wire:model.blur="masterForm.updated_by" id="masterForm.updated_by"
        name="masterForm.updated_by" placeholder="Updated By" />
    </div>

    <div class="mb-3">
      <x-input label="Created At" wire:model.blur="masterForm.created_at" id="masterForm.created_at"
        name="masterForm.created_at" placeholder="Created at" />
    </div>

    <div class="mb-3">
      <x-input label="Updated At" wire:model.blur="masterForm.updated_at" id="masterForm.updated_at"
        name="masterForm.updated_at" placeholder="Updated at" />
    </div>

    <div class="mb-3">
      <x-choices-offline wire:model="masterForm.is_activated" label="Is Activated" :options="[['id' => 0, 'name' => 'Inactive'], ['id' => 1, 'name' => 'Active']]" single
        searchable />
    </div>

    <div class="text-center mt-3">
      <x-errors class="text-white mb-3" />
      <x-button type="submit" :label="$id ? 'Update' : 'Store'" class="btn-success btn-sm text-white" />
    </div>
  </x-form>

</div>
