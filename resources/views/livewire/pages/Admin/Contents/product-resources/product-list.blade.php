<div>

  {{-- <div>
        wire:ignore <br />
        <span wire:ignore id="text1">text1 : {{ $text1 }} (wire:ignore)</span><br />
        <span>text1 : {{ $text1 }}</span><br />

        <input wire:model="text1" />
        <button x-on:click="document.querySelector('#text1').innerText='text1 : Coba (wire:ignore)'">Refresh</button>
    </div> --}}

  <x-drawer wire:model="ProductsFilter" title="Filter  {{ $title }}" right separator with-close-button
    class="">

    <x-form wire:submit.prevent="advancedSearch">

      <x-input placeholder="Filter By Name" wire:model.live.debounce="name" icon="o-magnifying-glass" clearable />
      <x-input placeholder="Filter By Selling Price " wire:model.live.debounce="selling_price" icon="o-magnifying-glass"
        clearable />
      <x-input placeholder="Filter By Image URL " wire:model.live.debounce="image_url" icon="o-magnifying-glass"
        clearable />

      <x-slot:actions>
        <x-button label="Filter" class="btn-primary" type="submit" spinner="save" />
        <x-button label="Reset" icon="o-x-mark" wire:click="clear" spinner />
      </x-slot:actions>

    </x-form>
  </x-drawer>


  <x-index-menu :title="$title" :url="$url" shadow />

  <div class="my-2">
    <x-input placeholder="Search..." wire:model.live.debounce="search" icon="o-magnifying-glass" clearable />
  </div>

  <div class="">

    <x-table :headers="$this->headers" class=" border border-gray-400 dark:border-gray-500" show-empty-text :rows="$this->products"
      :cell-decoration="$cell_decoration" :sort-by="$sortBy" with-pagination>

      @scope('cell_action', $product)
        <x-dropdown>
          <x-menu-item title="Edit" icon="o-pencil-square" link="products/edit/{{ $product->id }}" />
          <x-menu-item title="Show" icon="o-eye" link="products/show/{{ $product->id }}/readonly" />
          <x-menu-item title="Delete" wire:click="delete" wire:confirm="Yakin hapus data?" icon="o-trash" />
        </x-dropdown>
      @endscope

      @scope('cell_is_activated', $product)
        <x-badge :value="$product->is_activated == 1 ? 'Yes' : 'No'"
          class=" {{ $product->is_activated == 1 ? 'badge-primary badge-soft' : 'badge-error  badge-soft' }}" />
      @endscope

      @scope('cell_image_url', $product)
        <a href="{{ $product->image_url }}" class="px-4 underline underline-offset-1">{{ $product->image_url }}</a>
      @endscope

    </x-table>

  </div>


  @script
    <script>
      document.addEventListener('livewire:load', function() {


      });
    </script>
  @endscript


</div>
