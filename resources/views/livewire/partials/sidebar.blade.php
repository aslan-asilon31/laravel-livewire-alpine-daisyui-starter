<div>
  <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit ">

    {{-- BRAND --}}
    <x-app-brand class="px-5 pt-4 bg-white" />



    {{-- MENU --}}
    <x-menu activate-by-route class="md:pt-8  bg-white">

      @if ($user = auth()->user())
        <x-menu-separator />

        <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="-mx-2 !-my-2 rounded">
          <x-slot:actions>
            <x-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff" no-wire-navigate
              link="/logout" />
          </x-slot:actions>
        </x-list-item>
      @endif

      <x-menu-item title="Dashboard" icon="o-chart-bar-square" link="/dashboard" :class="request()->is('/dashboard1') ? 'active' : ''" />
      <x-menu-separator title="Master Data" icon="o-sparkles" />
      <x-menu-item title="Guest" icon="o-cube" link="/guest/" :class="request()->is('guest/') ? 'active' : ''" />
      <x-menu-item title="Room" icon="o-user-circle" link="/room/" :class="request()->is('room/') ? 'active' : ''" />
      <x-menu-item title="Bed" icon="o-user-circle" link="/bed/" :class="request()->is('bed/') ? 'active' : ''" />

      <x-menu-separator title="API" icon="o-sparkles" />
      <x-menu-item title="Barang" icon="o-user-circle" link="/barang/" :class="request()->is('barang/') ? 'active' : ''" />
      <x-menu-item title="Recipe" icon="o-user-circle" link="/recipe/" :class="request()->is('recipe/') ? 'active' : ''" />
      <x-menu-item title="Product" icon="o-user-circle" link="/product/" :class="request()->is('product/') ? 'active' : ''" />
      <x-menu-item title="Blog" icon="o-user-circle" link="/blog/" :class="request()->is('blog/') ? 'active' : ''" />

      <x-menu-separator title="Pengaturan" icon="o-sparkles" />
      <x-menu-sub title="Pengaturan" icon="o-cog-6-tooth">
        <x-menu-item title="Logout" icon="o-tag" link="/logout/" :class="request()->is('admin-logout/') ? 'active' : ''" />
        <x-menu-item title="Setting" icon-right="o-arrow-long-right" link="####" />
        <x-menu-item title="Backup" icon="o-arrow-long-right" link="####" />
      </x-menu-sub>

    </x-menu>
  </x-slot:sidebar>
</div>
