<div>

  <x-drawer wire:model="filterDrawer" class="w-11/12 lg:w-1/3" title="Filter" right separator with-close-button>

    <x-form wire:submit.prevent="filter">

      <x-input placeholder="Filter By ID" label="ID" wire:model="filterForm.id" icon="o-magnifying-glass" clearable />

      <x-input placeholder="Filter By First Name" label="First Name" wire:model="filterForm.first_name"
        icon="o-magnifying-glass" clearable />

      <x-input placeholder="Filter By Last Name" label="Last Name" wire:model="filterForm.last_name"
        icon="o-magnifying-glass" clearable />

      <x-datepicker wire:model="filterForm.date" label="Date" icon="o-calendar" :config="['altFormat' => 'd/m/Y']" />

      <x-input placeholder="Filter By Number" label="Number" wire:model="filterForm.number" icon="o-banknotes"
        clearable />

      <x-select wire:model="filterForm.status" label="Status" :options="[
          ['id' => 'pending', 'name' => 'Pending'],
          ['id' => 'settlement', 'name' => 'Settlement'],
          ['id' => 'failed', 'name' => 'Failed'],
      ]" placeholder="- Is Activated -"
        placeholder-value="" />

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

    <x-table :headers="$this->headers" class="table-sm border border-gray-400 dark:border-gray-500" :rows="$this->rows"
      :sort-by="$sortBy" with-pagination show-empty-text>
      @scope('cell_action', $row)
        <x-dropdown class="btn-xs" no-x-anchor>
          <x-menu-item title="Edit" icon="o-pencil-square" link="/sales-orders/edit/{{ $row->id }}" />

          <x-menu-item title="Show" icon="o-eye" link="/sales-orders/show/{{ $row->id }}" />
        </x-dropdown>
      @endscope
      @scope('cell_is_activated', $sales_order)
        <x-badge :value="$sales_order->is_activated == 1 ? 'Yes' : 'No'"
          class=" {{ $sales_order->is_activated == 1 ? 'badge-primary badge-soft' : 'badge-error  badge-soft' }}" />
      @endscope
    </x-table>

  </div>


</div>
