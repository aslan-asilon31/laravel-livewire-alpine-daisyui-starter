<div>

  <x-drawer wire:model="filterDrawer" class="w-11/12 lg:w-1/3" title="Filter" right separator with-close-button>

    <x-form wire:submit.prevent="filter">

      <x-input placeholder="Filter By ID" label="ID" wire:model="filterForm.id" icon="o-magnifying-glass" clearable />

      <x-input placeholder="Filter By First Name" label="Product Name" wire:model="filterForm.name"
        icon="o-magnifying-glass" clearable />


      <x-select wire:model="filterForm.is_activated" label="Is Activated" :options="[['id' => 1, 'name' => 'Yes'], ['id' => 0, 'name' => 'No']]"
        placeholder="- Is Activated -" placeholder-value="" />

      <x-input placeholder="Filter Created By" label="Created By" wire:model="filterForm.created_by" icon="o-banknotes"
        clearable />

      <x-input placeholder="Filter Updated By" label="Updated By" wire:model="filterForm.updated_by" icon="o-banknotes"
        clearable />


      <x-datepicker wire:model="filterForm.created_at" label="Created At" icon="o-calendar" :config="['altFormat' => 'd/m/Y']" />

      <x-datepicker wire:model="filterForm.updated_at" label="Updated At" icon="o-calendar" :config="['altFormat' => 'd/m/Y']" />

      <x-slot:actions>
        <x-button label="Filter" class="btn-primary" type="submit" spinner="filter" />
        <x-button label="Clear" wire:click="clear" spinner />
      </x-slot:actions>

    </x-form>
  </x-drawer>

  <x-list-menu :title="$title" :url="$url" shadow separator class="" />

  <div class="my-2">
    <x-input placeholder="Search..." wire:model.live.debounce.300ms="search" icon="o-magnifying-glass" clearable />
  </div>

  <div class="">


    <button label="Buat" @click="$wire.modalSalesOrderDetailCreate = true"
      class="border text-xs md:text-sm border-gray-800 text-gray-800 bg-transparent hover:bg-gray-800 hover:text-white font-semibold py-2 px-4 rounded transition duration-200">
      Create </button>

    <x-table :headers="$this->headers" class="table-sm border border-gray-400 dark:border-gray-500" :rows="$this->rows"
      :sort-by="$sortBy" with-pagination>
      @scope('cell_action', $row)
        <x-dropdown class="btn-xs">
          <x-menu-item title="Edit" icon="o-pencil-square" @click="$wire.edit('{{ $row->id }}')" />
          <x-menu-item title="Show" icon="o-eye" link="/sales-order-details/show/{{ $row->id }}/readonly" />
        </x-dropdown>
      @endscope
      @scope('cell_is_activated', $sales_order)
        <x-badge :value="$sales_order->is_activated == 1 ? 'Yes' : 'No'"
          class=" {{ $sales_order->is_activated == 1 ? 'badge-primary badge-soft' : 'badge-error  badge-soft' }}" />
      @endscope
    </x-table>

  </div>

  <x-modal wire:model="modalSalesOrderDetailCreate" class=" backdrop-blur">

    <x-form wire:submit="update" wire:confirm="Are you sure?">


      <div class="mb-3">
        <x-input label="Product ID" wire:model.blur="masterForm.product_id" id="masterForm.product_id"
          name="masterForm.product_id" placeholder="Product ID" />
      </div>

      <div class="mb-3">
        <x-input label="Product Name" wire:model.blur="masterForm.name" id="masterForm.name" name="masterForm.name"
          placeholder="Name" />
      </div>

      <div class="mb-3">
        <x-input label="Sales Order ID" wire:model.blur="masterForm.sales_order_id" id="masterForm.sales_order_id"
          name="masterForm.sales_order_id" placeholder="Sales Order ID" />
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

    <x-button label="Cancel" class="text-xs md:text-sm" wire.click="closeModal" />

  </x-modal>

  <x-modal wire:model="modalSalesOrderDetailClose" class="backdrop-blur text-xs md:text-sm">
    <x-button label="Cancel" wire.click="closeModal" />
  </x-modal>

</div>
