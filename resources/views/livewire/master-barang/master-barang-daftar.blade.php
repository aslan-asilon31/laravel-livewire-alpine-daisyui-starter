<div>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

  <x-list-menu :title="$title" :url="$url" shadow />


  <x-drawer wire:model="filterDrawer" class="w-11/12 lg:w-1/3" title="Filter" right separator with-close-button>

    <x-form wire:submit.prevent="filter">

      <x-input label="Nama" placeholder="Filter By Nama" wire:model="filterForm.nama" icon="o-magnifying-glass"
        clearable />

      <x-input label="Email" placeholder="Filter By Email" wire:model="filterForm.email" icon="o-magnifying-glass"
        clearable />
      <x-input label="No Telp" placeholder="Filter By No Telp" wire:model="filterForm.no_telp" icon="o-magnifying-glass"
        clearable />
      <x-input label="Dibuat Oleh" placeholder="Filter By Dibuat Oleh" wire:model="filterForm.created_by"
        icon="o-magnifying-glass" clearable />
      <x-input label="Diupdate Oleh" placeholder="Filter By Diupdate Oleh" wire:model="filterForm.updated_by"
        icon="o-magnifying-glass" clearable />

      <x-select label="Is Activated" wire:model="filterForm.status" :options="[['id' => 1, 'name' => 'Yes'], ['id' => 0, 'name' => 'No']]" placeholder="- Is Activated -"
        placeholder-value="" />

      <x-datepicker label="Tanggal Dibuat" wire:model="filterForm.tgl_dibuat" icon="o-calendar" :config="['altFormat' => 'd/m/Y']" />
      <x-datepicker label="Tanggal Diupdate" wire:model="filterForm.tgl_diupdate" icon="o-calendar" :config="['altFormat' => 'd/m/Y']" />

      <x-slot:actions>
        <x-button label="Filter" class="btn-primary" type="submit" spinner="filter" />
        <x-button label="Clear" wire:click="clear" spinner />
      </x-slot:actions>

    </x-form>
  </x-drawer>


  <div class="">

    <div x-data="productManager()" x-init="fetchData()">

      <h1 class="text-2xl font-bold">Products</h1>

      <!-- Button to open modal -->
      <button @click="openModal()" class="bg-green-500 text-white py-2 px-4 rounded mt-4">Add New Product</button>

      <!-- Loading text while fetching data -->
      <div x-show="products.length === 0" class="mt-4 text-gray-500">Loading...</div>

      <!-- Table to display products -->
      <table class="min-w-full bg-white border border-gray-300 mt-4">
        <thead>
          <tr>
            <th class="px-4 py-2 border">#</th>
            <th class="px-4 py-2 border">Image</th>
            <th class="px-4 py-2 border">Title</th>
            <th class="px-4 py-2 border">Description</th>
            <th class="px-4 py-2 border">Price</th>
            <th class="px-4 py-2 border">Actions</th>
          </tr>
        </thead>
        <tbody>
          <template x-for="(product, index) in products" :key="product.id">
            <tr>
              <td class="px-4 py-2 border" x-text="index + 1"></td>
              <td class="px-4 py-2 border">
                <img :src="product.image" :alt="product.title" class="w-16 h-16 object-cover rounded-md">
              </td>
              <td class="px-4 py-2 border" x-text="product.title"></td>
              <td class="px-4 py-2 border" x-text="product.description"></td>
              <td class="px-4 py-2 border" x-text="'$' + product.price"></td>
              <td class="px-4 py-2 border">
                <button @click="openModal(product)" class="text-blue-500">Edit</button>
                <button @click="deleteProduct(product.id)" class="text-red-500">Delete</button>
              </td>
            </tr>
          </template>
        </tbody>
      </table>

      <!-- Modal for creating and editing product -->
      <div x-show="showModal" x-transition.opacity
        class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg w-1/2">
          <h2 class="text-xl mb-4" x-text="currentProduct ? 'Edit Product' : 'Create New Product'"></h2>

          <label class="block mb-2">Title</label>
          <input x-model="currentProduct ? currentProduct.title : newProduct.title"
            class="w-full p-2 mb-4 border border-gray-300 rounded" type="text" placeholder="Product Title">

          <label class="block mb-2">Price</label>
          <input x-model="currentProduct ? currentProduct.price : newProduct.price"
            class="w-full p-2 mb-4 border border-gray-300 rounded" type="number" placeholder="Product Price">

          <label class="block mb-2">Description</label>
          <textarea x-model="currentProduct ? currentProduct.description : newProduct.description"
            class="w-full p-2 mb-4 border border-gray-300 rounded" placeholder="Product Description"></textarea>

          <button @click="currentProduct ? updateProduct() : createProduct()"
            class="bg-blue-500 text-white py-2 px-4 rounded">
            <span x-text="currentProduct ? 'Update' : 'Create'"></span> Product
          </button>
          <button @click="closeModal()" class="bg-gray-500 text-white py-2 px-4 rounded ml-2">Cancel</button>
        </div>
      </div>

    </div>

    <script>
      document.addEventListener('alpine:init', () => {
        Alpine.data('productManager', () => ({
          products: [],
          currentProduct: null,
          showModal: false,
          editProduct: null,
          newProduct: {
            title: '',
            price: 0,
            description: '',
            image: 'https://via.placeholder.com/150'
          },

          async fetchData() {
            try {
              const response = await axios.get('https://fakestoreapi.com/products');
              this.products = response.data;
            } catch (error) {
              console.error('Error fetching data:', error);
            }
          },

          openModal(product = null) {
            this.showModal = true;
            if (product) {
              this.currentProduct = product;
              this.editProduct = {
                title: product.title,
                price: product.price,
                description: product.description,
                image: product.image
              };
            } else {
              this.resetNewProduct(); // Creating new product
            }
          },

          closeModal() {
            this.showModal = false;
            this.currentProduct = null; // Clear current product after closing modal
          },

          resetNewProduct() {
            this.newProduct = {
              title: '',
              price: 0,
              description: '',
              image: 'https://via.placeholder.com/150'
            };
          },

          async createProduct() {
            if (!this.newProduct.title || !this.newProduct.price || !this.newProduct.description) {
              alert('Please fill in all fields');
              return;
            }

            if (this.newProduct.price <= 0) {
              alert('Price must be a positive number');
              return;
            }

            try {
              const response = await axios.post('https://fakestoreapi.com/products', this.newProduct);

              if (response.status === 200) {
                this.products.push(response.data); // Add the created product to the list
                this.closeModal(); // Close the modal after creation
              } else {
                const errorDescription = response.data.message || "An unknown error occurred";
                alert(`Failed to create product. Status: ${response.status} - ${errorDescription}`);
              }
            } catch (error) {
              console.error('Error creating product:', error);
              alert(`Failed to create product: ${error.message}`);
            }
          },

          async updateProduct() {
            if (!this.currentProduct || !this.editProduct) {
              alert("No product selected for update.");
              return;
            }

            try {
              const response = await axios.put(
                `https://fakestoreapi.com/products/${this.currentProduct.id}`,
                this.editProduct
              );

              if (response.status === 200 || response.status === 204) {
                const index = this.products.findIndex(p => p.id === this.currentProduct.id);
                if (index !== -1) {
                  this.products[index] = {
                    ...this.editProduct,
                    id: this.currentProduct.id
                  };
                }
                this.closeModal();
              } else {
                alert(`Failed to update product. Status: ${response.status}`);
              }
            } catch (error) {
              console.error('Error updating product:', error);
              alert(`Failed to update product: ${error.message}`);
            }
          },


          async deleteProduct(id) {
            const isConfirmed = window.confirm('Are you sure you want to delete this product?');

            if (!isConfirmed) {
              return;
            }

            try {
              const response = await axios.delete(`https://fakestoreapi.com/products/${id}`);

              if (response.status === 200) {
                this.products = this.products.filter(product => product.id !== id);
              } else {
                alert('Failed to delete product');
              }
            } catch (error) {
              console.error('Error deleting product:', error);
              alert('Failed to delete the product. Please try again.');
            }
          }
        }));
      });
    </script>



  </div>




</div>
