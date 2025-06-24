<!-- Include Alpine.js dan Axios -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<div x-data="productList()" x-init="init()" class="p-6">
  <h1 class="text-2xl font-bold mb-4">Product List</h1>

  <!-- Tabel Produk -->
  <table class="min-w-full bg-white border mt-4" x-show="products.length">
    <thead>
      <tr>
        <th class="px-4 py-2 border">#</th>
        <th class="px-4 py-2 border">Thumbnail</th>
        <th class="px-4 py-2 border">Title</th>
        <th class="px-4 py-2 border">Price</th>
        <th class="px-4 py-2 border">Stock</th>
        <th class="px-4 py-2 border">Actions</th>
      </tr>
    </thead>
    <tbody>
      <template x-for="(product, index) in products" :key="product.id">
        <tr>
          <td class="border px-4 py-2" x-text="index + 1"></td>
          <td class="border px-4 py-2">
            <img :src="product.thumbnail || 'https://via.placeholder.com/50'" class="w-12 h-12 object-cover rounded" />
          </td>
          <td class="border px-4 py-2" x-text="product.title"></td>
          <td class="border px-4 py-2" x-text="'$' + product.price"></td>
          <td class="border px-4 py-2" x-text="product.stock"></td>
          <td class="border px-4 py-2">
            <button @click="openEdit(product)" class="text-blue-500">Edit</button>
            <button @click="deleteProduct(product.id)" class="text-red-500 ml-2">Delete</button>
          </td>
        </tr>
      </template>
    </tbody>
  </table>

  <!-- Loading -->
  <div x-show="products.length === 0" class="mt-4 text-gray-600">Loading products...</div>

  <!-- Modal Edit -->
  <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center" x-transition>
    <div class="bg-white p-6 rounded w-full max-w-md">
      <h2 class="text-xl font-bold mb-4">Edit Product</h2>

      <label class="block mb-2">Title</label>
      <input type="text" class="w-full border p-2 rounded mb-4" x-model="form.title">

      <label class="block mb-2">Price</label>
      <input type="number" class="w-full border p-2 rounded mb-4" x-model="form.price">

      <label class="block mb-2">Stock</label>
      <input type="number" class="w-full border p-2 rounded mb-4" x-model="form.stock">

      <div class="flex justify-end gap-2">
        <button @click="saveEdit()" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
        <button @click="closeModal()" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
      </div>
    </div>
  </div>
</div>

<!-- Alpine Data Component -->
<script>
  document.addEventListener('alpine:init', () => {
    Alpine.data('productList', () => ({
      products: [],
      showModal: false,
      currentProduct: null,
      form: {
        title: '',
        price: 0,
        stock: 0
      },

      init() {
        this.fetchProducts();
      },

      async fetchProducts() {
        try {
          const res = await axios.get('https://dummyjson.com/products');
          this.products = res.data.products;
        } catch (err) {
          console.error("Failed to fetch products:", err);
        }
      },

      openEdit(product) {
        this.currentProduct = product;
        this.form = {
          title: product.title,
          price: product.price,
          stock: product.stock
        };
        this.showModal = true;
      },

      closeModal() {
        this.showModal = false;
        this.currentProduct = null;
      },

      saveEdit() {
        if (!this.currentProduct) return;

        const index = this.products.findIndex(p => p.id === this.currentProduct.id);
        if (index !== -1) {
          this.products[index] = {
            ...this.products[index],
            title: this.form.title,
            price: this.form.price,
            stock: this.form.stock
          };
        }

        this.closeModal();
      },

      deleteProduct(id) {
        if (confirm('Are you sure you want to delete this product?')) {
          this.products = this.products.filter(p => p.id !== id);
        }
      }
    }));
  });
</script>
