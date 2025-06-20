<div>
  <x-list-menu :title="$title" :url="$url" shadow :readonly="$isReadonly" />

  <div class="bg-white text-charcoal min-h-screen font-sans leading-normal overflow-x-hidden lg:overflow-auto">
    <div class="">
      <section class=" p-4 shadow">
        <div class="md:flex">
          {{-- <h2 class="md:w-1/3 uppercase tracking-wide text-sm sm:text-lg mb-6">INFORMASI PEGAWAI</h2> --}}
        </div>
        <form>
          <div class="md:flex mb-8 ">
            <div class="md:w-1/3">
              <legend class="uppercase tracking-wide text-sm">INFORMASI PEGAWAI</legend>
            </div>
            <div class="md:flex-1 mt-2 mb:mt-0 md:px-3">
              <div class="mb-4">
                <x-input label="Nama" class="w-full " wire:model="masterForm.nama" placeholder="" :readonly="$isReadonly" />
              </div>
              <div class="md:flex mb-4">
                <div class="md:flex-1 md:pr-3">
                  <x-input label="Username" class="w-full " wire:model="masterForm.username" placeholder=""
                    :readonly="$isReadonly" />
                </div>
                <div class="md:flex-1 md:pl-3">
                  <x-input label="Email" class="w-full " wire:model="masterForm.email" placeholder=""
                    :readonly="$isReadonly" />
                </div>
              </div>
              <div class="md:flex mb-4">
                <div class="md:flex-1 md:pr-3">
                  <x-input label="Jabatan" class="w-full "
                    value="{{ Auth::guard('pegawai')->user()->msPegawai->msJabatan->nama }}" placeholder=""
                    :readonly="$isReadonly" />
                </div>
                <div class="md:flex-1 md:pl-3">
                  <x-input label="Nomor Telepon" value="" class="w-full " wire:model="masterForm.no_telepon"
                    placeholder="" :readonly="$isReadonly" />
                </div>
              </div>
            </div>
          </div>

          <div class="md:flex mb-6">
            <div class="md:w-1/3">
              <img src="https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg" class="w-32"
                alt="" srcset="">
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
              <button class="btn btn-primary">Edit</button>
            </div>
          </div>
        </form>
      </section>
    </div>
  </div>

</div>
