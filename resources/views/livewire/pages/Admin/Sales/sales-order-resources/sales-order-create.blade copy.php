<div>
  <x-card :title="$title" shadow separator class="border shadow">


    <div class="grid grid-cols-2 mb-4">
      <div>
        <x-button label="List" link="{{ $url }}" class="btn-ghost btn-outline" />
      </div>
    </div>

    <x-form wire:submit="{{ $detailIndex >= 0 ? 'updateDetail' : 'storeDetail' }}">
      <x-choices label="Product" wire:model.live="detailForm.product_id" :options="$productsSearchable" placeholder="Product ..."
        search-function="searchProduct" single searchable />

      <div>
        Product Name : {{ $detailForm['product_name'] }}
      </div>

      <x-input label="Selling Price" wire:model="detailForm.selling_price" placeholder="Selling Price" />

      <x-input label="Quantity" wire:model="detailForm.qty" placeholder="Qty" />


      <div class="text-center mt-3">
        <x-errors class="text-white mb-3" />
        <x-button type="submit" label="{{ $detailIndex >= 0 ? 'Update' : 'Store' }} Detail {{ $detailIndex }}"
          class="btn-success btn-sm text-white" />
      </div>
    </x-form>

    <hr />


    <x-form wire:submit="{{ $id ? 'update' : 'store' }}">

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="mb-3">
          <x-choices label="Employee" wire:model="headerForm.employee_id" :options="$employeesSearchable" placeholder="Employee ..."
            search-function="searchEmployee" single searchable />
        </div>

        <div class="mb-3">
          <x-choices label="Customer" wire:model="headerForm.customer_id" :options="$customersSearchable" placeholder="Customer ..."
            search-function="searchCustomer" option-value="id" option-label="first_name" single searchable />
        </div>

        <div class="mb-3">
          <x-datepicker label="Date" wire:model="headerForm.date" icon="o-calendar" />
        </div>

        <div class="mb-3">
          <x-choices-offline wire:model="headerForm.is_activated" label="Is Activated" :options="[['id' => 0, 'name' => 'Inactive'], ['id' => 1, 'name' => 'Active']]" single
            searchable />
        </div>
      </div>

      <x-button label="Tambah Detail Sales Order" class="btn-sm btn-success text-white" wire:click="createDetail" />

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
          @forelse ($details as $index => $row)
            <tr>
              <td class="border px-4 py-2">
                <x-dropdown class="btn-xs">
                  <x-menu-item title="Edit" icon="o-pencil-square" wire:click="editDetail({{ $index }})" />
                  <x-menu-item title="Delete" icon="o-trash" wire:click="deleteDetail({{ $index }})"
                    wire:confirm="are you sure ?" />
                </x-dropdown>
              </td>
              <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
              <td class="border px-4 py-2">{{ $row['product_name'] ?? '' }}</td>
              <td class="border px-4 py-2">{{ $row['selling_price'] ?? '' }}</td>
              <td class="border px-4 py-2">{{ $row['qty'] ?? '' }}</td>
            </tr>
          @empty
            <tr>
              <td class="border px-4 py-2 text-center" colspan="100%">No data available.</td>
            </tr>
          @endforelse

        </tbody>
      </table>


      <div class="text-center mt-3">
        <x-errors class="text-white mb-3" />
        <x-button type="submit" :label="$id ? 'Update' : 'Store'" class="btn-success btn-sm text-white" />
      </div>
    </x-form>
  </x-card>
</div>
