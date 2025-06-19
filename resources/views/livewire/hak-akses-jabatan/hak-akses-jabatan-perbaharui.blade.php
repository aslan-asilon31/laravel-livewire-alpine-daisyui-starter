<div>
  <div>
    <x-list-menu :title="$title" :url="$url" :id="$id" shadow class="" />
    <x-form wire:submit="{{ $id ? 'update' : 'simpan' }}" class="bg-white p-2">

      <div id="pertanyaan">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

          <div class="mb-3" hidden>
            <x-input label="id" wire:model="masterForm.id" id="masterForm.id" nama="masterForm.id" placeholder="id"
              :disabled="true" />
          </div>

          <div class="mb-3" hidden>
            <x-input label="id" wire:model="masterForm.tgl_dibuat" id="masterForm.tgl_dibuat"
              nama="masterForm.tgl_dibuat" placeholder="id" :disabled="true" />
          </div>

          <div class="mb-3" hidden>
            <x-input label="id" wire:model="masterForm.tgl_diupdate" id="masterForm.tgl_diupdate"
              nama="masterForm.tgl_diupdate" placeholder="id" :disabled="true" />
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
            <x-select label="Status" wire:model="masterForm.status" :options="[['id' => 'aktif', 'name' => 'Aktif'], ['id' => 'tidak-aktif', 'name' => 'Tidak Aktif']]" />
          </div>
        </div>

      </div>

      <br>

      @php
        $actions = ['daftar', 'buat', 'simpan', 'edit', 'update', 'lihat'];
        $subActions = ['simpan', 'update'];
      @endphp

      <div class="flex items-center space-x-4 mb-3">
        <label class="flex items-center space-x-1">
          <input type="checkbox" wire:model="checkAll" wire:change="toggleCheckAll"
            class="form-checkbox h-4 w-4 text-blue-600">
          <span>Centang Semua Aksi</span>
        </label>

        <label class="flex items-center space-x-1">
          <input type="checkbox" wire:model="checkAllSub" wire:change="toggleCheckAllSub"
            class="form-checkbox h-4 w-4 text-green-600">
          <span>Centang Semua Sub Aksi (Status)</span>
        </label>
      </div>


      <div class="overflow-auto w-full m-2">
        <table class="w-96 border border-gray-200 text-sm">
          <thead class="bg-gray-100">

            <tr>

              <th class="px-2 py-1  border-b ">Hak Akses {{ strtoupper($masterForm->nama) }}
              </th>
              @foreach ($actions as $action)
                <th class="px-2 py-1 text-center border-b whitespace-nowrap capitalize">{{ $action }}</th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            @foreach ($groupedByPrefix as $prefix => $permissions)
              <tr class="border-b hover:bg-gray-50 align-top">
                <td class="px-4 py-2 font-semibold text-gray-700 w-16">
                  {{ ucfirst($prefix) }}
                </td>
                @foreach ($actions as $action)
                  <td class="text-center px-2 py-2 whitespace-nowrap align-top">
                    @php
                      $permission = $permissions[$action] ?? null;
                    @endphp

                    @if ($permission)
                      <x-checkbox label="{{ $permission->nama }}" class="" wire:model="selectedPermissions"
                        value="{{ $permission->id }}" />


                      @if (!in_array($action, ['daftar', 'lihat']))
                        <div class="mt-2 space-y-1 ">
                          @foreach ($statuses as $status)
                            @php
                              $statusKey = $permission->id . '_' . $status->id;
                              $isChecked = in_array($statusKey, $selectedStatusPermissions ?? []);
                              $isDisabled = !in_array($permission->id, $selectedPermissions ?? []);
                            @endphp
                            <label class="flex items-center space-x-1 text-xs m-2">

                              <x-checkbox label="{{ ucfirst($status->nama) }}" wire:model="selectedStatusPermissions"
                                value="{{ $statusKey }}" style="width:20px;" />

                            </label>
                          @endforeach
                        </div>
                      @endif
                    @else
                      <span class="text-gray-400">—</span>
                    @endif
                  </td>
                @endforeach
              </tr>
            @endforeach


          </tbody>
        </table>
      </div>

      <div class="text-center mt-3">
        <x-errors class="text-white mb-3" />
        <x-button type="submit" :label="$id ? 'update' : 'simpan'" class="btn-success btn-sm text-white" />
        <x-button label="batal" class="btn-error btn-sm text-white" link="/pemesanan-penjualan" />
      </div>
    </x-form>


  </div>
</div>
