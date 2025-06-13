<div>
  <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit ">

    {{-- BRAND --}}
    <x-app-brand class="px-5 pt-4" />



    {{-- MENU --}}
    <x-menu activate-by-route class="md:pt-8 ">

      @if ($user = auth()->user())
        <x-menu-separator />

        <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="-mx-2 !-my-2 rounded">
          <x-slot:actions>
            <x-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff" no-wire-navigate
              link="/logout" />
          </x-slot:actions>
        </x-list-item>
      @endif

      <x-menu-item title="Dashboard" icon="o-chart-bar-square" link="/" :class="request()->is('dashboard') ? 'active' : ''" />
      <x-menu-separator title="Management" icon="o-sparkles" />
      <x-menu-item title="Master Barang" icon="o-archive-box" link="/products" :class="request()->is('products') ? 'active' : ''" />
      <x-menu-item title="Master Cabang" icon="o-archive-box" link="/cabang" :class="request()->is('cabang') ? 'active' : ''" />
      <x-menu-item title="Master Gudang" icon="o-archive-box" link="/gudang" :class="request()->is('gudang') ? 'active' : ''" />
      <x-menu-item title="Master Pegawai" icon="o-archive-box" link="/pegawai" :class="request()->is('pegawai') ? 'active' : ''" />
      <x-menu-item title="Master Pelanggan" icon="o-archive-box" link="/pelanggan" :class="request()->is('pelanggan') ? 'active' : ''" />
      <x-menu-item title="Master Status" icon="o-archive-box" link="/status" :class="request()->is('status') ? 'active' : ''" />
      <x-menu-item title="Master File" icon="o-archive-box" link="/file" :class="request()->is('file') ? 'active' : ''" />
      <x-menu-item title="Master File Jenis" icon="o-archive-box" link="/file-jenis" :class="request()->is('file-jenis') ? 'active' : ''" />
      <x-menu-item title="pesanan Penjualan" icon="o-archive-box" link="/tr-pesanan-penjualan" :class="request()->is('tr-pemesanan-penjualan') ? 'active' : ''" />

      <x-menu-sub title="Settings" icon="o-cog-6-tooth">
        <x-menu-item title="Setting" icon-right="o-arrow-long-right" link="####" />
        <x-menu-item title="Backup" icon="o-arrow-long-right" link="####" />
      </x-menu-sub>

    </x-menu>
  </x-slot:sidebar>
</div>
