<div>
    
    <x-drawer wire:model="SalesOrdersFilter" title="Filter {{ $title }}" right separator with-close-button class="">
        <x-input placeholder="Search..." wire:model.live.debounce="search" icon="o-magnifying-glass" @keydown.enter="$wire.drawer = false" />

        <x-slot:actions>
            <x-button label="Reset" icon="o-x-mark" wire:click="clear" spinner />
            <x-button label="Done" icon="o-check" class="btn-primary" @click="$wire.drawer = false" />
        </x-slot:actions>
    </x-drawer>

    <x-index-menu :title="$title" :url="$url"    shadow separator class="" />

    <div class="">

        <x-table :headers="$this->headers"  class=""   :rows="$this->sales_orders" :cell-decoration="$cell_decoration" :sort-by="$sortBy"   with-pagination>
            @scope('cell_is_activated', $sales_order)
                <x-badge :value="$sales_order->is_activated == 1 ? 'Yes':'No' " class=" {{ $sales_order->is_activated == 1 ? 'badge-primary badge-soft': 'badge-error  badge-soft'}}" />
            @endscope
        </x-table>

    </div>


</div>
