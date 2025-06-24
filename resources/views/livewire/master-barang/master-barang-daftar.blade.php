<div>

  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

  <div x-data>
    <button @click="$store.productCrud.openModal()" class="bg-green-500 text-white py-2 px-4 rounded mt-4">Add New
      Product</button>

    <template x-if="$store.productCrud.showModal">
      <div class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg w-1/2">
          <h2 class="text-xl mb-4" x-text="$store.productCrud.currentProduct ? 'Edit Product' : 'Create New Product'">
          </h2>

          <label class="block mb-2">Title</label>
          <input
            x-model="$store.productCrud.currentProduct ? $store.productCrud.editProduct.title : $store.productCrud.newProduct.title"
            class="w-full p-2 mb-4 border border-gray-300 rounded" type="text" placeholder="Product Title" />

          <!-- input lainya serupa -->

          <button
            @click="$store.productCrud.currentProduct ? $store.productCrud.updateProduct() : $store.productCrud.createProduct()"
            class="bg-blue-500 text-white py-2 px-4 rounded">
            <span x-text="$store.productCrud.currentProduct ? 'Update' : 'Create'"></span> Product
          </button>
          <button @click="$store.productCrud.closeModal()"
            class="bg-gray-500 text-white py-2 px-4 rounded ml-2">Cancel</button>
        </div>
      </div>
    </template>

    <!-- tabel dan list produk -->
    <table>
      <tbody>
        <template x-for="(product, index) in $store.productCrud.products" :key="product.id">
          <tr>
            <td x-text="index + 1"></td>
            <td><img :src="product.image" :alt="product.title" /></td>
            <td x-text="product.title"></td>
            <td x-text="product.description"></td>
            <td x-text="'$' + product.price"></td>
            <td>
              <button @click="$store.productCrud.openModal(product)">Edit</button>
              <button @click="$store.productCrud.deleteProduct(product.id)">Delete</button>
            </td>
          </tr>
        </template>
      </tbody>
    </table>


    <script>
      document.addEventListener('alpine:init', () => {
        Alpine.store('productCrud', {
          products: [],
          currentProduct: null,
          showModal: false,
          editProduct: null,

          productFormInit: {
            title: '',
            price: 0,
            description: '',
            image: 'https://via.placeholder.com/150',
          },

          newProduct: {},

          init() {
            this.resetNewProduct();
            this.fetchData();
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
                image: product.image,
              };
            } else {
              this.resetNewProduct();
              this.currentProduct = null;
              this.editProduct = null;
            }
          },

          closeModal() {
            this.showModal = false;
            this.currentProduct = null;
            this.editProduct = null;
            this.resetNewProduct();
          },

          resetNewProduct() {
            this.newProduct = {
              ...this.productFormInit
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
              if (response.status === 200 || response.status === 201) {
                this.products.push(response.data);
                this.closeModal();
              } else {
                const errorDescription = response.data.message || 'An unknown error occurred';
                alert(`Failed to create product. Status: ${response.status} - ${errorDescription}`);
              }
            } catch (error) {
              console.error('Error creating product:', error);
              alert(`Failed to create product: ${error.message}`);
            }
          },

          async updateProduct() {
            if (!this.currentProduct || !this.editProduct) {
              alert('No product selected for update.');
              return;
            }

            try {
              const response = await axios.put(
                `https://fakestoreapi.com/products/${this.currentProduct.id}`,
                this.editProduct
              );

              if (response.status === 200 || response.status === 204) {
                const index = this.products.findIndex((p) => p.id === this.currentProduct.id);
                if (index !== -1) {
                  this.products[index] = {
                    ...this.editProduct,
                    id: this.currentProduct.id,
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
            if (!isConfirmed) return;

            try {
              const response = await axios.delete(`https://fakestoreapi.com/products/${id}`);
              if (response.status === 200) {
                this.products = this.products.filter((product) => product.id !== id);
              } else {
                alert('Failed to delete product');
              }
            } catch (error) {
              console.error('Error deleting product:', error);
              alert('Failed to delete the product. Please try again.');
            }
          }
        });
      });
    </script>
  </div>

</div>
