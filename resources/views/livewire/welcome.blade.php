<div>
  <x-list-menu :title="$title" :url="$url" shadow />


  <x-card>
    <div class="space-y-4 p-4">

      <div class="w-12/12">
        <div class="flex flex-row">
          <div class="bg-no-repeat  rounded-xl w-7/12 mr-2 p-6 shadow-lg "
            style="background-image: url(); background-position: 90% center;">
            <canvas id="salesLineChart" width="800" height="400"></canvas>

          </div>

          <div class="bg-no-repeat   rounded-xl w-5/12 ml-2 p-6" style=" background-position: 100% 40%;">
            <div class="">
              <div>
                <p class="text-2xl text-indigo-900 ">Selamat Datang
                  <br><strong>{{ Auth::guard('pegawai')->user()->msPegawai->nama }}</strong>
                </p>
                <h6 class="">Anda Login Sebagai
                  <b>{{ Auth::guard('pegawai')->user()->msPegawai->msJabatan->nama ?? 'tidak ada jabatan' }}</b>
                </h6>
              </div>
              <div>
                <img src="{{ asset('frontend/assets/img/flat-img1.png') }}" class="w-48" alt=""
                  srcset="">
              </div>
            </div>
          </div>
        </div>
        <div class="flex flex-row h-64 mt-6">
          <div class="bg-white bg-blue-100 border border-blue-200 rounded-xl shadow-lg px-6 py-4 w-4/12">
            <canvas id="barChart" width="400" height="200"></canvas>
          </div>
          <div class="bg-white bg-blue-100 border border-blue-200 rounded-xl shadow-lg mx-6 px-6 py-4 w-4/12">
            <canvas id="pieChart"></canvas>
          </div>
          <div class="bg-white bg-blue-100 border border-blue-200 rounded-xl shadow-lg px-6 py-4 w-4/12">
            <canvas id="lineChart"></canvas>
          </div>
        </div>
      </div>



    </div>
  </x-card>


  <!-- FILTER DRAWER -->
  <x-drawer wire:model="drawer" title="Filters" right separator with-close-button class="lg:w-1/3">
    <x-input placeholder="Search..." wire:model.live.debounce="search" icon="o-magnifying-glass"
      @keydown.enter="$wire.drawer = false" />

    <x-slot:actions>
      <x-button label="Reset" icon="o-x-mark" wire:click="clear" spinner />
      <x-button label="Done" icon="o-check" class="btn-primary" @click="$wire.drawer = false" />
    </x-slot:actions>
  </x-drawer>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


  <script>
    const ctx = document.getElementById('salesLineChart').getContext('2d');

    new Chart(ctx, {
      type: 'line',
      data: {
        labels: @json($labelMonths),
        datasets: @json($datasetProducts)
      },
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: 'Pendapatan Tiap Bulan di Tahun 2025'
          },
          legend: {
            position: 'top'
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Units Sold'
            }
          },
          x: {
            title: {
              display: true,
              text: 'Month'
            }
          }
        }
      }
    });
  </script>

  <script>
    // Bar Chart
    new Chart(document.getElementById('barChart'), {
      type: 'bar',
      data: {
        labels: @json($barData['labels']),
        datasets: [{
          label: 'Bar Sample',
          data: @json($barData['data']),
          backgroundColor: 'rgba(75, 192, 192, 0.5)'
        }]
      }
    });

    // Pie Chart
    new Chart(document.getElementById('pieChart'), {
      type: 'pie',
      data: {
        labels: @json($pieData['labels']),
        datasets: [{
          data: @json($pieData['data']),
          backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
        }]
      }
    });

    // Line Chart
    new Chart(document.getElementById('lineChart'), {
      type: 'line',
      data: {
        labels: @json($lineData['labels']),
        datasets: [{
          label: 'Line Sample',
          data: @json($lineData['data']),
          borderColor: '#4BC0C0',
          fill: false
        }]
      }
    });
  </script>

</div>
