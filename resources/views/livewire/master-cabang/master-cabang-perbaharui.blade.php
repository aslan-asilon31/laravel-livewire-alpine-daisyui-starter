<div>
  <div>
    @dump($isReadonly)
    <x-list-menu :title="$title" :url="$url" :id="$id" shadow class="" />
    <x-form wire:submit="{{ $id ? 'update' : 'simpan' }}" class="bg-white p-2">

      <div id="pertanyaan">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

          <div class="mb-3" hidden>
            <x-input label="id" wire:model="masterForm.id" id="masterForm.id" nama="masterForm.id" placeholder="id"
              :disabled="true" />
          </div>

          <div class="mb-3">
            <x-input label="Nama" wire:model.blur="masterForm.nama" id="masterForm.nama" nama="masterForm.nama"
              placeholder="Nama" :readonly="$isReadonly" />
            <div wire:loading wire:target="masterForm.nama">
              Typing Nama ...
            </div>
          </div>

          <div class="mb-3">
            <x-input label="Nomor" wire:model.blur="masterForm.nomor" id="masterForm.nomor" nama="masterForm.nomor"
              placeholder="nomor" :readonly="true" />
            <div wire:loading wire:target="masterForm.nomor">
              Typing nomor ...
            </div>
          </div>

          <div class="mb-3">
            <x-select label="Status" wire:model="masterForm.status" :options="$optionStatus" />
          </div>
        </div>



      </div>


      <div class="bg-white p-2">

        <x-header title="Pemesanan Penjualan Detail" subtitle="">
          <x-slot:actions>
            <x-button label="Filters" @click="$wire.filterDrawer = true" responsive icon="o-funnel"
              class="btn-primary" />
          </x-slot:actions>
        </x-header>





      </div>



      <div class="text-center mt-3">
        <x-errors class="text-white mb-3" />
        <x-button type="submit" :label="$id ? 'edit' : 'simpan'" class="btn-success btn-sm text-white" />
        <x-button label="batal" class="btn-error btn-sm text-white" link="/pemesanan-penjualan" />
      </div>
    </x-form>


  </div>
</div>
