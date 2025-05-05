<div>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

  <x-card :title="$title" shadow separator class="border shadow">
    <x-form wire:submit="store">

      <div class="grid grid-cols-2 mb-4">
        <div>

          <x-button label="List" link="{{ $url }}" class="btn-ghost btn-outline" />

        </div>
        <div class="text-right">
          <x-button label="Delete" wire:click="delete" wire:confirm="Apakah kamu yakin ingin menghapus data ini?"
            class="btn-ghost btn-outline text-red-500" />
        </div>
      </div>

      <input wire:model="masterForm.employee_id" type="hidden" />
      <input wire:model="masterForm.customer_id" type="hidden" />
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">


        <div class="mb-3">
          <x-choices label="Customer" wire:model="masterForm.customer_id" :options="$this->customers()" single clearable />
        </div>


        <div class="mb-3">
          <x-datepicker label="Date" wire:model="masterForm.date" icon="o-calendar" />
        </div>

        <div class="mb-3">
          <x-select label="Employee" wire:model="masterForm.employee_id" :options="$this->employees()" single clearable />
        </div>

        <div class="mb-3">
          <x-choices-offline wire:model="masterForm.is_activated" label="Is Activated" :options="[['id' => 0, 'name' => 'Inactive'], ['id' => 1, 'name' => 'Active']]" single
            searchable />
        </div>
      </div>


      <x-button label="Tambah Detail Sales Order" class="btn-success text-white" @click="$wire.createDetail" />
      <table class="table-auto w-full border border-gray-300 text-left text-sm mt-8">
        <thead class="bg-gray-100">
          <tr>
            <th class="border px-4 py-2">Action</th>
            <th class="border px-4 py-2">#</th>
            <th class="border px-4 py-2">Product Name</th>
            <th class="border px-4 py-2">Selling Price</th>
            <th class="border px-4 py-2">Quantity</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($details as $row)
            <tr>
              <td class="border px-4 py-2">
                <x-dropdown class="btn-xs">
                  <x-menu-item title="Edit" icon="o-pencil-square" wire:click="editDetail('{{ $row['id'] }}')" />
                  <x-menu-item title="Delete" icon="o-pencil-square" wire:click="deleteDetail('{{ $row['id'] }}')"
                    wire:confirm="are you sure ?" />
                </x-dropdown>
              </td>
              <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
              <td class="border px-4 py-2">{{ $row['product_name'] ?? '' }}</td>
              <td class="border px-4 py-2">{{ $row['qty'] ?? '' }}</td>
              <td class="border px-4 py-2">{{ $row['selling_price'] ?? '' }}</td>
            </tr>
          @empty
            <tr>
              <td class="border px-4 py-2 text-center" colspan="4">No data available.</td>
            </tr>
          @endforelse

        </tbody>
      </table>



      <div class="text-center mt-3">
        <x-errors class="text-white mb-3" />
        <x-button type="submit" :label="'Store'" class="btn-success btn-sm text-white" />
      </div>
    </x-form>
  </x-card>


  <x-modal wire:model="modalDetail" title="Sales Order Detail" class="backdrop-blur">
    <x-form wire:submit="{{ $detailId ? 'updateDetail' : 'storeDetail' }}">
      <div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

          <div class="mb-3">
            <x-select label="Product" wire:model="masterFormDetail.product_id" :options="$this->products()" option-label="name"
              option-value="id" icon="o-user" />
          </div>

          <div class="mb-3">
            <x-input label="Selling Price" wire:model="masterFormDetail.selling_price"
              id="masterFormDetail.selling_price" name="masterFormDetail.selling_price" placeholder="Selling Price" />
          </div>

          <div class="mb-3">
            <x-input label="Quantity" wire:model="masterFormDetail.qty" id="masterFormDetail.qty"
              name="masterFormDetail.qty" placeholder="Quantity" />
          </div>

          <div class="mb-3">
            <x-choices-offline wire:model="masterFormDetail.is_activated" label="Is Activated" :options="[['id' => 0, 'name' => 'Inactive'], ['id' => 1, 'name' => 'Active']]" single
              searchable />
          </div>


        </div>

      </div>
      <x-slot:actions>
        <x-button type="submit" :label="$detailId ? 'Update' : 'Store'" class="btn-success btn-sm text-white" />

        <x-button label="Cancel" @click="$wire.modalDetail = false" />
      </x-slot:actions>
    </x-form>
  </x-modal>

</div>
