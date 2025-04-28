<div >
  <x-index-menu  :title="$title" :url="$url" />



  <x-drawer wire:model="CustomersFilter" title="Filter  {{ $title }}" right separator with-close-button class="">
      <x-input placeholder="Search..." wire:model.live.debounce="search" icon="o-magnifying-glass" @keydown.enter="$wire.drawer = false" />

      <x-slot:actions>
          <x-button label="Reset" icon="o-x-mark" wire:click="clear" spinner />
          <x-button label="Done" icon="o-check" class="btn-primary" @click="$wire.drawer = false" />
      </x-slot:actions>
  </x-drawer>


  <div class="">

      <x-table :headers="$this->headers"  class="" :rows="$this->customers" :cell-decoration="$cell_decoration" :sort-by="$sortBy"   with-pagination>

          @scope('cell_action', $customer)
              <x-dropdown>
                  <x-menu-item title="Edit" icon="o-pencil-square" link="customers/edit/{{ $customer->id }}" />
                  <x-menu-item title="Show" icon="o-eye"  link="customers/show/{{ $customer->id }}/readonly"  />
                  <x-menu-item title="Delete" wire:click="delete" wire:confirm="Yakin hapus data?" icon="o-trash" />
              </x-dropdown>
          @endscope

          @scope('cell_is_activated', $customer)
              <x-badge :value="$customer->is_activated == 1 ? 'Yes':'No' " class=" {{ $customer->is_activated == 1 ? 'badge-primary badge-soft': 'badge-error  badge-soft'}}" />
          @endscope

      </x-table>

  </div>



  {{-- <livewire:pages.admin.sales.customer-resources.components.customer-table /> --}}

</div>
