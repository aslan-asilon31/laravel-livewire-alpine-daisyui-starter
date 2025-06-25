<div>


  <!-- Include Alpine.js dan Axios -->
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script src="https://cdn.sheetjs.com/xlsx-0.20.0/package/dist/xlsx.full.min.js"></script>



  @dump($allProducts2, $count)

  <div>

    <div x-data="{ count: $wire.$entangle('allProducts2') }">
      <h2 x-text="count"></h2>

      <!-- Tombol untuk Increment dan Decrement -->
      <button @click="count++" class="bg-blue-500 text-white px-4 py-2 rounded">Increment Alpine.js</button>
      <button @click="count--" class="bg-yellow-500 text-white px-4 py-2 rounded">Decrement Alpine.js</button>
    </div>

    <!-- Menampilkan nilai count dari Livewire -->
    <div>
      <h3>Current count from Livewire: {{ $count }}</h3>
    </div>

  </div>



  <br>

  <div>
    <h3>Daftar Produk</h3>
    <ul>
      @forelse ($products1 as $product)
        <li>{{ $product['title'] }} - {{ $product['price'] }}</li>
      @empty
        <li>tidak ada products1</li>
      @endforelse
    </ul>
  </div>


  <hr>


  {{-- <div x-data="{ count: @entangle('count') }"> --}}
  <div x-data="{ count: 0 }">
    <button @click="count++">Increment Count</button>

    <p>Current Count: <span x-text="count"></span></p>
  </div>


  <button wire:click="showData" class="bg-purple-500 text-white px-4 py-2 rounded">
    Show Data
  </button>

  <div x-data="loadingIndicator" x-show="loading" x-cloak x-on:loading="loading = true" x-on:unloading="loading = false"
    class="fixed inset-0 flex items-center justify-center bg-gray-100 bg-opacity-75 z-50">
    <div class="flex mx-auto space-x-4">
      <!-- Loading spinner icon -->
      <svg class="w-8 h-8 animate-spin text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v2a6 6 0 00-6 6h2l-4 4-4-4h2a8 8 0 010-8z">
        </path>
      </svg>
      <span class="text-lg font-semibold">Loading...</span>
    </div>
  </div>



  {{-- <x-loading /> --}}

  <div x-data="productList" x-init="init()" class="p-6">
    <h1 class="text-2xl font-bold mb-4">Product List</h1>
    <button @click="sendToLivewire()">Kirim ke Livewire</button>


    <!-- Search -->
    <input type="text" x-model="searchQuery" @input="filterProducts()" placeholder="Search products..."
      class="border p-2 mb-4 w-full rounded" />

    <button @click="exportCSV()" class="mb-4 bg-purple-500 text-white px-4 py-2 rounded">
      Export CSV
    </button>

    <button @click="exportExcel()" class="mb-4 bg-purple-600 text-white px-4 py-2 rounded">
      Export Excel
    </button>
    {{-- 
  <x-button class="" wire:click="exportExcel">Export1</x-button>


  <button type="button" wire:click="exportExcel">
    Export Excel2
  </button> --}}




    <!-- Tabel Produk -->
    <table class="min-w-full bg-white border mt-2" x-show="paginatedProducts.length">
      <thead>
        <tr>
          <th class="px-4 py-2 border">#</th>
          <th class="px-4 py-2 border">Thumbnail</th>
          <th class="px-4 py-2 border cursor-pointer" @click="sortBy('title')">Title</th>
          <th @click="sortBy('price')" class="cursor-pointer">
            Price
            <span x-show="sortKey === 'price'">
              {{-- <template x-if="sortAsc">↑</template> --}}
              {{-- <template x-if="!sortAsc">↓</template> --}}
            </span>
          </th>

          <th class="px-4 py-2 border cursor-pointer" @click="sortBy('stock')">Stock</th>
          <th class="px-4 py-2 border">Actions</th>
        </tr>
      </thead>
      <tbody>
        <template x-for="(product, index) in paginatedProducts" :key="product.id">
          <tr>
            <td class="border px-4 py-2" x-text="(currentPage - 1) * perPage + index + 1"></td>
            <td class="border px-4 py-2">
              <img :src="product.thumbnail || 'https://via.placeholder.com/50'"
                class="w-12 h-12 object-cover rounded" />
            </td>
            <td class="border px-4 py-2" x-text="product.title"></td>
            <td class="border px-4 py-2" x-text="'$' + product.price"></td>
            <td class="border px-4 py-2" x-text="product.stock"></td>
            <td class="border px-4 py-2">
              <button @click="openEdit(product)" class="text-purple-500">Edit</button>
              <button @click="deleteProduct(product.id)" class="text-red-500 ml-2">Delete</button>
            </td>
          </tr>
        </template>
      </tbody>
    </table>

    <!-- Pagination Controls -->
    <div class="mt-4 flex justify-between items-center">
      <div>
        Page <span x-text="currentPage"></span> of <span x-text="totalPages"></span>
      </div>
      <div class="space-x-2">
        <button @click="prevPage()" :disabled="currentPage === 1" class="px-4 py-1 bg-gray-300 rounded">Prev</button>
        <button @click="nextPage()" :disabled="currentPage === totalPages"
          class="px-4 py-1 bg-gray-300 rounded">Next</button>
      </div>
    </div>

    <!-- Loading -->
    <div x-show="allProducts.length === 0" class="mt-4 text-gray-600">Loading products...</div>

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
          <button @click="saveEdit()" class="bg-purple-500 text-white px-4 py-2 rounded">Save</button>
          <button @click="closeModal()" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Alpine Data Component -->


  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.data('loadingIndicator', () => ({
        loading: false, // Inisialisasi status loading
        timer: null, // Simpan timer
        minLoadingTime: 10000, // Minimal waktu loading 10 detik

        init() {
          // Mendeteksi event Livewire loading
          Livewire.on('loading', () => {
            this.startLoading();
          });

          Livewire.on('unloading', () => {
            this.stopLoading();
          });

          // Hook Livewire untuk otomatis menonaktifkan loading
          Livewire.hook('request', ({
            respond,
            succeed,
            fail
          }) => {
            respond(() => {
              this.stopLoading();
            });

            succeed(() => {
              this.stopLoading();
            });

            fail(({
              preventDefault
            }) => {
              this.stopLoading();
              preventDefault();
            });
          });
        },

        startLoading() {
          // Reset timer jika ada loading sebelumnya
          if (this.timer) {
            clearTimeout(this.timer);
          }

          // Set timer untuk menampilkan loading setelah 2 detik
          this.timer = setTimeout(() => {
            this.loading = true;
          }, 2000); // 2 detik delay
        },

        stopLoading() {
          if (this.loading) {
            // Pastikan loading berlangsung selama 10 detik
            setTimeout(() => {
              this.loading = false;
            }, this.minLoadingTime); // Set loading selama minimal 10 detik
          }
        },
      }));
    });
  </script>

  <script>
    document.addEventListener('alpine:init', () => {

      Alpine.data('productList', () => ({
        loading: false,
        allProducts: [],
        filteredProducts: [],
        paginatedProducts: [],
        currentPage: 1,
        perPage: 5,
        totalPages: 1,
        sortKey: '',
        sortAsc: true,

        searchQuery: '',
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
            const res = await axios.get('https://dummyjson.com/products?limit=100');
            this.allProducts = res.data.products;



            Livewire.dispatch('send-to-livewire', JSON.parse(JSON.stringify(this.allProducts)));
            var productsToSend = JSON.parse(JSON.stringify(this.allProducts));
            window.dispatchEvent(new CustomEvent('send-to-livewire', {
              detail: {
                products: productsToSend
              }
            }));

            console.log('cek data fetch', productsToSend);
            this.filterProducts();
          } catch (err) {
            console.error("Failed to fetch products:", err);
          }
        },

        filterProducts() {
          const query = this.searchQuery.toLowerCase();
          this.filteredProducts = this.allProducts.filter(p =>
            p.title.toLowerCase().includes(query) ||
            String(p.price).includes(query) ||
            String(p.stock).includes(query)
          );

          this.updateUrlSearch();
          this.sortData();
        },

        exportCSV() {
          const headers = ['ID', 'Title', 'Price', 'Stock'];
          const rows = this.filteredProducts.map(p => [p.id, p.title, p.price, p.stock]);

          let csvContent = "data:text/csv;charset=utf-8," + [headers.join(','), ...rows.map(e => e.join(
              ','))]
            .join("\n");

          const encodedUri = encodeURI(csvContent);
          const link = document.createElement("a");
          link.setAttribute("href", encodedUri);
          link.setAttribute("download", "products.csv");
          document.body.appendChild(link);
          link.click();
          document.body.removeChild(link);
        },


        exportExcel() {
          const now = new Date();
          const headers = ['ID', 'Title', 'Price', 'Stock', 'Date'];
          const data = this.filteredProducts.map(p => ({
            ID: p.id,
            Title: p.title,
            Price: p.price,
            Stock: p.stock,
            Date: now.toLocaleString()
          }));

          const worksheet = XLSX.utils.json_to_sheet(data, {
            header: headers,
            cellDates: true
          });


          const range = XLSX.utils.decode_range(worksheet['!ref']);
          for (let R = range.s.r + 1; R <= range.e.r; ++R) {
            // === Format tanggal ===
            const dateRef = XLSX.utils.encode_cell({
              c: 4,
              r: R
            });
            const dateCell = worksheet[dateRef];
            if (dateCell && dateCell.v) {
              const parsed = new Date(dateCell.v);
              if (!isNaN(parsed)) {
                dateCell.t = 'n';
                dateCell.v = dateToExcelSerial(parsed);
                dateCell.z = 'dd/mm/yyyy hh:mm';
              }
            }

            // === Format price (kolom 6) ===
            const priceRef = XLSX.utils.encode_cell({
              c: 5,
              r: R
            });
            const priceCell = worksheet[priceRef];
            if (priceCell && !isNaN(priceCell.v)) {
              priceCell.t = 'n';
              priceCell.z = '"$"#,##0.00'; // currency format
            }

            // === Format stock (kolom 7) ===
            const stockRef = XLSX.utils.encode_cell({
              c: 6,
              r: R
            });
            const stockCell = worksheet[stockRef];
            if (stockCell && !isNaN(stockCell.v)) {
              stockCell.t = 'n';
              stockCell.z = '0'; // integer number
            }
          }


          const workbook = XLSX.utils.book_new();
          XLSX.utils.book_append_sheet(workbook, worksheet, "Products");

          const timestamp = now.toISOString().replace(/[:.-]/g, "_");
          const filename = `products_${timestamp}.xlsx`;

          XLSX.writeFile(workbook, filename);

        },

        dateToExcelSerial(date) {
          const epoch = new Date(Date.UTC(1899, 11, 30));
          return (date - epoch) / (24 * 60 * 60 * 1000);
        },


        sendToLivewire() {
          @this.call('receiveProducts', this.products);
        },

        sortBy(key) {
          this.sortAsc = this.sortKey === key ? !this.sortAsc : true;
          this.sortKey = key;
          this.sortData();
        },

        sortData() {
          if (this.sortKey) {
            this.filteredProducts.sort((a, b) => {
              const valA = a[this.sortKey];
              const valB = b[this.sortKey];

              // Case-insensitive if string
              if (typeof valA === 'string' && typeof valB === 'string') {
                return this.sortAsc ? valA.localeCompare(valB) : valB.localeCompare(valA);
              }

              // Numeric or fallback
              return this.sortAsc ? valA - valB : valB - valA;
            });
          }

          this.totalPages = Math.ceil(this.filteredProducts.length / this.perPage);
          this.goToPage(1); // Reset to page 1
        },


        goToPage(page) {
          this.currentPage = page;
          const start = (page - 1) * this.perPage;
          const end = start + this.perPage;
          this.paginatedProducts = this.filteredProducts.slice(start, end);
        },

        updateUrlSearch() {
          const url = new URL(window.location);
          if (this.searchQuery) {
            url.searchParams.set('search', this.searchQuery); // set or update search param
          } else {
            url.searchParams.delete('search'); // remove search param if empty
          }
          window.history.pushState({}, '', url); // Update URL without reloading
        },


        nextPage() {
          if (this.currentPage < this.totalPages) this.goToPage(this.currentPage + 1);
        },

        prevPage() {
          if (this.currentPage > 1) this.goToPage(this.currentPage - 1);
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
          const index = this.allProducts.findIndex(p => p.id === this.currentProduct.id);
          if (index !== -1) {
            this.allProducts[index] = {
              ...this.allProducts[index],
              title: this.form.title,
              price: this.form.price,
              stock: this.form.stock
            };
          }
          this.filterProducts();
          this.closeModal();
        },

        deleteProduct(id) {
          if (confirm('Are you sure you want to delete this product?')) {
            this.allProducts = this.allProducts.filter(p => p.id !== id);
            this.filterProducts();
          }
        }
      }));
    });
  </script>


  @script
    <script>
      document.addEventListener('livewire:init', () => {

        let $wire = {
          count: 10,
        }
        console.log('1');
      })

      document.addEventListener('livewire:initialized', () => {

        let $wire = {
          count: 10,
        }
        console.log('2');

        let component = Livewire.all()[0];

        if (component.snapshotEncoded) {
          let snapshotData = JSON.parse(component.snapshotEncoded);

          console.log('Title:', snapshotData.data.title); // Output: Product
          console.log('Products:', snapshotData.data.products); // Output: [[], {"s": "arr"}]
          console.log('Count:', snapshotData.data.count); // Output: 0
        } else {
          console.log('No snapshotEncoded data found');
        }




      })
    </script>
  @endscript



</div>
