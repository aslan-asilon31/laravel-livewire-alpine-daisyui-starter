<div>
  <x-list-menu :title="$title" :url="$url" shadow />

  <div class="bg-cream text-charcoal min-h-screen font-sans leading-normal overflow-x-hidden lg:overflow-auto">
    <div class="flex-1 md:p-0 lg:pt-8 lg:px-8 md:ml-24 flex flex-col">
      <section class="bg-cream-lighter p-4 shadow">
        <div class="md:flex">
          <h2 class="md:w-1/3 uppercase tracking-wide text-sm sm:text-lg mb-6">INFORMASI PEGAWAI</h2>
        </div>
        <form>
          <div class="md:flex mb-8">
            <div class="md:w-1/3">
              <legend class="uppercase tracking-wide text-sm">Location</legend>
              <p class="text-xs font-light text-red">This entire section is required.</p>
            </div>
            <div class="md:flex-1 mt-2 mb:mt-0 md:px-3">
              <div class="mb-4">
                <label class="block uppercase tracking-wide text-xs font-bold">Name</label>
                <input class="w-full shadow-inner p-4 border-0" type="text" name="name"
                  placeholder="Acme Mfg. Co.">
              </div>
              <div class="md:flex mb-4">
                <div class="md:flex-1 md:pr-3">
                  <label class="block uppercase tracking-wide text-charcoal-darker text-xs font-bold">Street
                    Address</label>
                  <input class="w-full shadow-inner p-4 border-0" type="text" name="address_street"
                    placeholder="555 Roadrunner Lane">
                </div>
                <div class="md:flex-1 md:pl-3">
                  <label class="block uppercase tracking-wide text-charcoal-darker text-xs font-bold">Building/Suite
                    No.</label>
                  <input class="w-full shadow-inner p-4 border-0" type="text" name="address_number" placeholder="#3">
                  <span class="text-xs mb-4 font-thin">We lied, this isn't required.</span>
                </div>
              </div>
              <div class="md:flex mb-4">
                <div class="md:flex-1 md:pr-3">
                  <label class="block uppercase tracking-wide text-charcoal-darker text-xs font-bold">Latitude</label>
                  <input class="w-full shadow-inner p-4 border-0" type="text" name="lat"
                    placeholder="30.0455542">
                </div>
                <div class="md:flex-1 md:pl-3">
                  <label class="block uppercase tracking-wide text-charcoal-darker text-xs font-bold">Longitude</label>
                  <input class="w-full shadow-inner p-4 border-0" type="text" name="lon"
                    placeholder="-99.1405168">
                </div>
              </div>
            </div>
          </div>
          <div class="md:flex mb-8">
            <div class="md:w-1/3">
              <legend class="uppercase tracking-wide text-sm">Contact</legend>
            </div>
            <div class="md:flex-1 mt-2 mb:mt-0 md:px-3">
              <div class="mb-4">
                <label class="block uppercase tracking-wide text-xs font-bold">Phone</label>
                <input class="w-full shadow-inner p-4 border-0" type="tel" name="phone"
                  placeholder="(555) 555-5555">
              </div>
              <div class="mb-4">
                <label class="block uppercase tracking-wide text-charcoal-darker text-xs font-bold">URL</label>
                <input class="w-full shadow-inner p-4 border-0" type="url" name="url" placeholder="acme.co">
              </div>
              <div class="mb-4">
                <label class="block uppercase tracking-wide text-charcoal-darker text-xs font-bold">Email</label>
                <input class="w-full shadow-inner p-4 border-0" type="email" name="email"
                  placeholder="contact@acme.co">
              </div>
            </div>
          </div>
          <div class="md:flex">
            <div class="md:w-1/3">
              <legend class="uppercase tracking-wide text-sm">Social</legend>
            </div>
            <div class="md:flex-1 mt-2 mb:mt-0 md:px-3">
              <div class="md:flex mb-4">
                <div class="md:flex-1 md:pr-3">
                  <label class="block uppercase tracking-wide text-charcoal-darker text-xs font-bold">Facebook</label>
                  <div class="w-full flex">
                    <span class="text-xs py-4 px-2 bg-grey-light text-grey-dark">facebook.com/</span>
                    <input class="flex-1 shadow-inner p-4 border-0" type="text" name="facebook" placeholder="acmeco">
                  </div>
                </div>
                <div class="md:flex-1 md:pl-3 mt-2 md:mt-0">
                  <label class="block uppercase tracking-wide text-charcoal-darker text-xs font-bold">Twitter</label>
                  <div class="w-full flex">
                    <span class="text-xs py-4 px-2 bg-grey-light text-grey-dark">twitter.com/</span>
                    <input class="flex-1 shadow-inner p-4 border-0" type="text" name="twitter" placeholder="acmeco">
                  </div>
                </div>
              </div>
              <div class="md:flex mb-4">
                <div class="md:flex-1 md:pr-3">
                  <label class="block uppercase tracking-wide text-charcoal-darker text-xs font-bold">Instagram</label>
                  <div class="w-full flex">
                    <span class="text-xs py-4 px-2 bg-grey-light text-grey-dark">instagram.com/</span>
                    <input class="flex-1 shadow-inner p-4 border-0" type="text" name="instagram"
                      placeholder="acmeco">
                  </div>
                </div>
                <div class="md:flex-1 md:pl-3 mt-2 md:mt-0">
                  <label class="block uppercase tracking-wide text-charcoal-darker text-xs font-bold">Yelp</label>
                  <div class="w-full flex">
                    <span class="text-xs py-4 px-2 bg-grey-light text-grey-dark">yelp.com/</span>
                    <input class="flex-1 shadow-inner p-4 border-0" type="text" name="yelp"
                      placeholder="acmeco">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="md:flex mb-6">
            <div class="md:w-1/3">
              <legend class="uppercase tracking-wide text-sm">Description</legend>
            </div>
            <div class="md:flex-1 mt-2 mb:mt-0 md:px-3">
              <textarea class="w-full shadow-inner p-4 border-0" placeholder="We build fine acmes." rows="6"></textarea>
            </div>
          </div>
          <div class="md:flex mb-6">
            <div class="md:w-1/3">
              <legend class="uppercase tracking-wide text-sm">Cover Image</legend>
            </div>
            <div class="md:flex-1 px-3 text-center">
              <div class="button bg-gold hover:bg-gold-dark text-cream mx-auto cusor-pointer relative">
                <input class="opacity-0 absolute pin-x pin-y" type="file" name="cover_image">
                Add Cover Image
              </div>
            </div>
          </div>
          <div class="md:flex mb-6 border border-t-1 border-b-0 border-x-0 border-cream-dark">
            <div class="md:flex-1 px-3 text-center md:text-right">
              <input type="hidden" name="sponsor" value="0">
              <input class="button text-cream-lighter bg-brick hover:bg-brick-dark" type="submit"
                value="Create Location">
            </div>
          </div>
        </form>
      </section>
    </div>
  </div>



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



</div>
