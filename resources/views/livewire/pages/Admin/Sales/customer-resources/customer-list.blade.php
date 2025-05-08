<div>
  <x-list-menu :title="$title" :url="$url" shadow />

  <x-drawer wire:model="filterDrawer" class="w-11/12 lg:w-1/3" title="Filter" right separator with-close-button>

    <x-form wire:submit.prevent="filter">

      <x-input label="First Name" placeholder="Filter By First Name" wire:model="filterForm.first_name"
        icon="o-magnifying-glass" clearable />
      <x-input label="Last Name" placeholder="Filter By Last Name" wire:model="filterForm.last_name"
        icon="o-magnifying-glass" clearable />
      <x-input label="Email" placeholder="Filter By Email" wire:model="filterForm.email" icon="o-magnifying-glass"
        clearable />
      <x-input label="Phone" placeholder="Filter By Phone" wire:model="filterForm.phone" icon="o-magnifying-glass"
        clearable />
      <x-input label="Created By" placeholder="Filter By Created By" wire:model="filterForm.created_by"
        icon="o-magnifying-glass" clearable />
      <x-input label="Updated By" placeholder="Filter By Updated By" wire:model="filterForm.updated_by"
        icon="o-magnifying-glass" clearable />

      <x-select label="Is Activated" wire:model="filterForm.is_activated" :options="[['id' => 1, 'name' => 'Yes'], ['id' => 0, 'name' => 'No']]"
        placeholder="- Is Activated -" placeholder-value="" />

      <x-datepicker label="Created At" wire:model="filterForm.created_at" icon="o-calendar" :config="['altFormat' => 'd/m/Y']" />
      <x-datepicker label="Updated At" wire:model="filterForm.updated_at" icon="o-calendar" :config="['altFormat' => 'd/m/Y']" />

      <x-slot:actions>
        <x-button label="Filter" class="btn-primary" type="submit" spinner="filter" />
        <x-button label="Clear" wire:click="clear" spinner />
      </x-slot:actions>

    </x-form>
  </x-drawer>


  <div class="my-2">
    <x-input placeholder="Search..." wire:model.live.debounce.300ms="search" icon="o-magnifying-glass" clearable />
  </div>

  <div class="">

    <x-table :headers="$this->headers" class="" :rows="$this->rows" :sort-by="$sortBy" with-pagination show-empty-text>

      @scope('cell_action', $row)
        <x-dropdown>
          <x-menu-item title="Edit" icon="o-pencil-square" link="/customers/edit/{{ $row->id }}" />
          <x-menu-item title="Show" icon="o-eye" link="/customers/show/{{ $row->id }}/readonly" />
        </x-dropdown>
      @endscope

      @scope('cell_is_activated', $row)
        <x-badge :value="$row->is_activated == 1 ? 'Yes' : 'No'"
          class=" {{ $row->is_activated == 1 ? 'badge-primary badge-soft' : 'badge-error  badge-soft' }}" />
      @endscope

    </x-table>

  </div>



  {{-- <livewire:pages.admin.sales.customer-resources.components.customer-table /> --}}

</div>
