<div>


  <!-- Include Alpine.js dan Axios -->
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script src="https://cdn.sheetjs.com/xlsx-0.20.0/package/dist/xlsx.full.min.js"></script>

  <x-list-menu :title="$title" :url="$url" shadow />


  <x-drawer wire:model="filterDrawer" class="w-11/12 lg:w-1/3" title="Filter" right separator with-close-button>

    <x-form wire:submit.prevent="filter">

      <x-input label="id" placeholder="Filter By id" wire:model="filterForm.id" icon="o-magnifying-glass" clearable />

      <x-input label="title" placeholder="Filter By title" wire:model="filterForm.title" icon="o-magnifying-glass"
        clearable />

      <x-input label="availabilityStatus" placeholder="Filter By availabilityStatus"
        wire:model="filterForm.availabilityStatus" icon="o-magnifying-glass" clearable />

      <x-input label="category" placeholder="Filter By category" wire:model="filterForm.category"
        icon="o-magnifying-glass" clearable />

      <x-input label="description" placeholder="Filter By description" wire:model="filterForm.description"
        icon="o-magnifying-glass" clearable />

      <x-input label="dimensions.depth" placeholder="Filter By dimensions.depth"
        wire:model="filterForm.dimensions.depth" icon="o-magnifying-glass" clearable />

      <x-input label="dimensions.height" placeholder="Filter By dimensions.height"
        wire:model="filterForm.dimensions.height" icon="o-magnifying-glass" clearable />


      <x-input label="dimensions.width" placeholder="Filter By dimensions.width"
        wire:model="filterForm.dimensions.width" icon="o-magnifying-glass" clearable />

      <x-slot:actions>
        <x-button label="Filter" class="btn-primary" type="submit" spinner="filter" />
        <x-button label="Clear" wire:click="clear" spinner />
      </x-slot:actions>

    </x-form>
  </x-drawer>

  <div x-data="productList" x-init="init()" class="p-6">

    <div class="my-2">
      <x-input placeholder="Search..." wire:model.live.debounce.300ms="search" icon="o-magnifying-glass" clearable />
    </div>

    <div class="">

      <x-table :headers="$this->headers" class="table-sm border border-gray-400 dark:border-gray-500" :rows="$this->rows"
        :sort-by="$sortBy" with-pagination show-empty-text>



      </x-table>

    </div>



  </div>

  <!-- Alpine Data Component -->


  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.data('loadingIndicator', () => ({
        loading: false,
        timer: null,
        minLoadingTime: 10000,

        init() {
          Livewire.on('loading', () => {
            this.startLoading();
          });

          Livewire.on('unloading', () => {
            this.stopLoading();
          });

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
          if (this.timer) {
            clearTimeout(this.timer);
          }

          this.timer = setTimeout(() => {
            this.loading = true;
          }, 2000); // 2 detik delay
        },

        stopLoading() {
          if (this.loading) {
            setTimeout(() => {
              this.loading = false;
            }, this.minLoadingTime);
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
              priceCell.z = '"$"#,##0.00';
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
