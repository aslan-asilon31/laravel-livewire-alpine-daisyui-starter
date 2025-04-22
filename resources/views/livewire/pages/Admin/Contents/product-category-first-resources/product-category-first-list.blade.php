<div :title="$title" shadow separator class="border shadow">

  <x-card  :title="$title"  :url="$url" >


    <x-button label="Create" link="{{ $url . '/create' }}" class="btn-ghost btn-outline" />
    <livewire:pages.admin.contents.product-category-first-resources.components.product-category-first-table />

  </x-card>
</div>
