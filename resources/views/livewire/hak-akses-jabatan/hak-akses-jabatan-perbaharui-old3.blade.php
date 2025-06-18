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

      <br>


      @php
        $actions = ['daftar', 'buat', 'simpan', 'edit', 'update', 'lihat'];
        $subActions = ['daftar', 'buat', 'simpan', 'edit', 'update', 'lihat'];
      @endphp

      <table class="w-auto table-auto border border-gray-200 text-sm">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-2 py-1 text-left border-b whitespace-nowrap">Hak Akses</th>
            @foreach ($actions as $action)
              <th class="px-2 py-1 text-center border-b whitespace-nowrap capitalize">{{ $action }}</th>
            @endforeach
          </tr>
        </thead>
        <tbody>
          @foreach ($groupedPermissions as $prefix => $permissions)
            @dump($permissions)

            <tr class="border-b hover:bg-gray-50 align-top">
              <td class="px-4 py-2 font-semibold text-gray-700 whitespace-nowrap">{{ $prefix }}</td>

              @foreach ($actions as $action)
                <td class="text-center px-2 py-2 whitespace-nowrap">
                  @if (isset($permissions[$action]))
                    {{-- Checkbox utama --}}
                    <input type="checkbox" wire:model="selectedPermissions" value="{{ $permissions[$action]->id }}"
                      class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out"
                      title="{{ $permissions[$action]->nama }}">

                    {{-- Sub-checkbox untuk status --}}
                    @if (in_array($action, $subActions))
                      <div class="mt-2 space-y-1 text-left">
                        @foreach ($statuses as $status)
                          @php
                            $statusKey = $permissions[$action]->id . '_' . $status->id;
                          @endphp
                          <label class="flex items-center space-x-1 text-xs">
                            <input type="checkbox" wire:model="selectedStatusPermissions" value="{{ $statusKey }}"
                              class="form-checkbox h-3 w-3 text-green-600">
                            <span>{{ ucfirst($status->nama) }}</span>
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


      <br>

      <div class="overflow-x-auto p-4">
        <table class="min-w-full table-auto border border-gray-200">
          <thead class="bg-gray-100">
            <tr>
              <th class="px-4 py-2 text-left border-b">Hak Akses</th>
              <th class="px-4 py-2 text-center border-b">Daftar</th>
              <th class="px-4 py-2 text-center border-b">Buat</th>
              <th class="px-4 py-2 text-center border-b">Simpan</th>
              <th class="px-4 py-2 text-center border-b">Edit</th>
              <th class="px-4 py-2 text-center border-b">Update</th>
              <th class="px-4 py-2 text-center border-b">Lihat</th>
            </tr>
          </thead>
          <tbody class="text-sm">
            <tr class="border-b hover:bg-gray-50">
              <td class="px-4 py-2">ms_barang-lihat</td>
              <td class="text-center">
                <x-checkbox label="" wire:model="item1" />
              </td>
              <td class="text-center">
                <x-checkbox label="" wire:model="item1" />
              </td>
              <td class="text-center">
                <x-checkbox label="" wire:model="item1" />
              </td>
              <td class="text-center">
                <x-checkbox label="" wire:model="item1" />
              </td>
              <td class="text-center">
                <x-checkbox label="" wire:model="item1" />
              </td>
            </tr>
            <tr class="border-b hover:bg-gray-50">
              <td class="px-4 py-2">ms_barang-buat</td>
              <td class="text-center">
                <x-checkbox label="" wire:model="item1" />
              </td>
              <td class="text-center">
                <x-checkbox label="" wire:model="item1" />
              </td>
              <td class="text-center">
                <x-checkbox label="" wire:model="item1" />
              </td>
              <td class="text-center">
                <x-checkbox label="" wire:model="item1" />
              </td>
              <td class="text-center">
                <x-checkbox label="" wire:model="item1" />
              </td>
            </tr>
            <tr class="border-b hover:bg-gray-50">
              <td class="px-4 py-2">ms_barang-simpan</td>
              <td class="text-center">
                <x-checkbox label="" wire:model="item1" />
              </td>
              <td class="text-center">
                <x-checkbox label="" wire:model="item1" />
              </td>
              <td class="text-center">
                <x-checkbox label="" wire:model="item1" />
              </td>
              <td class="text-center">
                <x-checkbox label="" wire:model="item1" />
              </td>
              <td class="text-center">
                <x-checkbox label="" wire:model="item1" />
              </td>
            </tr>
            <tr class="border-b hover:bg-gray-50">
              <td class="px-4 py-2">ms_barang-edit</td>
              <td class="text-center">
                <x-checkbox label="" wire:model="item1" />
              </td>
              <td class="text-center">
                <x-checkbox label="" wire:model="item1" />
              </td>
              <td class="text-center">
                <x-checkbox label="" wire:model="item1" />
              </td>
              <td class="text-center">
                <x-checkbox label="" wire:model="item1" />
              </td>
              <td class="text-center">
                <x-checkbox label="" wire:model="item1" />
              </td>
            </tr>
            <tr class="border-b hover:bg-gray-50">
              <td class="px-4 py-2">ms_barang-update</td>
              <td class="text-center">
                <x-checkbox label="" wire:model="item1" />
              </td>
              <td class="text-center">
                <x-checkbox label="" wire:model="item1" />
              </td>
              <td class="text-center">
                <x-checkbox label="" wire:model="item1" />
              </td>
              <td class="text-center">
                <x-checkbox label="" wire:model="item1" />
              </td>
              <td class="text-center">
                <x-checkbox label="" wire:model="item1" />
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <br>


      @php
        $actions = ['daftar', 'buat', 'simpan', 'edit', 'update', 'lihat'];
      @endphp

      @foreach ($groupedPermissions as $group => $permissionsInGroup)
        <div class="mb-8 border rounded-lg shadow-sm overflow-x-auto">
          <h4 class="text-lg font-semibold p-4 bg-gray-100 border-b">{{ ucfirst($group) }}</h4>
          <table class="min-w-full table-auto border border-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-4 py-2 text-left border-b">Hak Akses</th>
                @foreach ($actions as $action)
                  <th class="px-4 py-2 text-center border-b">{{ ucfirst($action) }}</th>
                @endforeach
              </tr>
            </thead>
            <tbody class="text-sm bg-white">
              <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-2 font-medium">{{ $group }}</td>
                @foreach ($actions as $action)
                  @php
                    $permission = collect($permissionsInGroup)->firstWhere('nama', "{$group}-{$action}");
                  @endphp
                  <td class="text-center">
                    @if ($permission)
                      <input type="checkbox" value="{{ $permission->id }}" wire:model="selectedPermissions"
                        class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out" />
                    @else
                      <span class="text-gray-300">—</span>
                    @endif
                  </td>
                @endforeach
              </tr>
            </tbody>
          </table>
        </div>
      @endforeach






  </div>



  <div class="text-center mt-3">
    <x-errors class="text-white mb-3" />
    <x-button type="submit" :label="$id ? 'edit' : 'simpan'" class="btn-success btn-sm text-white" />
    <x-button label="batal" class="btn-error btn-sm text-white" link="/pemesanan-penjualan" />
  </div>
  </x-form>


</div>
</div>
