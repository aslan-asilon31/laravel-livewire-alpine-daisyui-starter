<div>
    <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit">

        {{-- BRAND --}}
        <x-app-brand class="px-5 pt-4" />



        {{-- MENU --}}
        <x-menu activate-by-route class="md:pt-8">


            {{-- User --}}
            @if($user = auth()->user())
                <x-menu-separator />

                <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="-mx-2 !-my-2 rounded">
                    <x-slot:actions>
                        <x-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff" no-wire-navigate link="/logout" />
                    </x-slot:actions>
                </x-list-item>

            @endif

              
            <div class="flex flex-col justify-center items-center  ">

                <div class="pb-4">
                    <img src="{{ asset('user-no.png') }}" alt="" srcset="" class="md:w-24">
                    <p class="font-bold">Aslan (Admin)</p>
                    <p class="font-bold">Cabang : A</p>
                </div>

            </div>
  
            <x-menu-item title="Dashboard" icon="o-home" link="/"  :class=" request()->is('dashboard') ? 'active' : ''"  />
                <x-menu-separator title="Management" icon="o-sparkles" />
                <x-menu-item title="Employee" icon="o-user-group" link="/employees" :class="request()->is('employees') ? 'active' : ''" />
                <x-menu-item title="Employee Account" icon="o-users" link="/employee-accounts" :class="request()->is('employee-accounts') ? 'active' : ''" />
                <x-menu-item title="Position" icon="o-squares-2x2" link="/positions" :class="request()->is('positions') ? 'active' : ''" />
                <x-menu-item title="Page" icon="o-squares-2x2" link="/pages" :class="request()->is('pages') ? 'active' : ''" />
                <x-menu-item title="Permission" icon="o-squares-2x2" link="/permissions" :class="request()->is('permissions') ? 'active' : ''" />
              
                <x-menu-separator title="Content" icon="o-sparkles" />
              
                <x-menu-item title="Marketplace" icon="o-building-storefront" link="/marketplaces" :class="request()->is('marketplaces') ? 'active' : ''" />
              
                <x-menu-item title="Meta Property Group" icon="o-squares-2x2" link="/meta-property-groups" :class="request()->is('meta-property-groups') ? 'active' : ''" />
              
                <x-menu-item title="Meta Property " icon="o-squares-2x2" link="/meta-properties" :class="request()->is('meta-properties') ? 'active' : ''" />
              
                <x-menu-item title="Product Category 1" icon="o-squares-2x2" link="/product-category-firsts" :class="request()->is('product-category-firsts') ? 'active' : ''" />
                <x-menu-item title="Product Category 2" icon="o-squares-2x2" link="/product-category-seconds" :class="request()->is('product-category-seconds') ? 'active' : ''" />
            
                <x-menu-item title="Product Brand " icon="o-squares-2x2" link="/product-brands" :class="request()->is('product-brands') ? 'active' : ''" />
                    
                <x-menu-item title="Product " icon="o-squares-2x2" link="/products" :class="request()->is('products') ? 'active' : ''" />
              
                <x-menu-item title="Product Content" icon="o-squares-2x2" link="/product-contents" :class="request()->is('product-contents') ? 'active' : ''" />
              
                <x-menu-item title="Category Recommendation" icon="o-squares-2x2" link="/category-recommendations" :class="request()->is('category-recommendations') ? 'active' : ''" />
            
            
                <x-menu-separator title="Sales" icon="o-chart-bar-square" />
                <x-menu-item title="Customer" icon="o-users" link="/customers" />
                <x-menu-item title="Sales Order " badge="{{ $salesOrderStatusPending->count() }} pending" badge-classes="!badge-warning" icon="o-squares-2x2" link="/sales-orders" :class="request()->is('products') ? 'active' : ''"    />
              
            
            <x-menu-sub title="Settings" icon="o-cog-6-tooth">
                <x-menu-item title="Wifi" icon="o-wifi" link="####" />
                <x-menu-item title="Archives" icon="o-archive-box" link="####" />
            </x-menu-sub>
        </x-menu>
    </x-slot:sidebar>
</div>
