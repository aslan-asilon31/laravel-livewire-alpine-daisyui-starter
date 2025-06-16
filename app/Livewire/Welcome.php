<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;
use Mary\Traits\Toast;

class Welcome extends Component
{
    use Toast;

    public string $search = '';

    public bool $drawer = false;

    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    // Clear filters
    public function clear(): void
    {
        $this->reset();
        $this->success('Filters cleared.', position: 'toast-bottom');
    }

    // Delete action
    public function delete($id): void
    {
        $this->warning("Will delete #$id", 'It is fake.', position: 'toast-bottom');
    }

    // Table headers
    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'name', 'label' => 'Name', 'class' => 'w-64'],
            ['key' => 'age', 'label' => 'Age', 'class' => 'w-20'],
            ['key' => 'email', 'label' => 'E-mail', 'sortable' => false],
        ];
    }

    /**
     * For demo purpose, this is a static collection.
     *
     * On real projects you do it with Eloquent collections.
     * Please, refer to maryUI docs to see the eloquent examples.
     */
    public function users(): Collection
    {
        return collect([
            ['id' => 1, 'name' => 'Mary', 'email' => 'mary@mary-ui.com', 'age' => 23],
            ['id' => 2, 'name' => 'Giovanna', 'email' => 'giovanna@mary-ui.com', 'age' => 7],
            ['id' => 3, 'name' => 'Marina', 'email' => 'marina@mary-ui.com', 'age' => 5],
        ])
            ->sortBy([[...array_values($this->sortBy)]])
            ->when($this->search, function (Collection $collection) {
                return $collection->filter(fn(array $item) => str($item['name'])->contains($this->search, true));
            });
    }

    public function mount()
    {
        // dd(\Illuminate\Support\Facades\Auth::guard('pegawai'));


        // $akses_cabang = \Illuminate\Support\Facades\DB::table('hak_akses_pegawai_cabang as hapc')
        //     ->join('ms_cabang as mc', 'hapc.ms_cabang_id', '=', 'mc.id')
        //     ->join('ms_pegawai as mp', 'mp.id', '=', 'hapc.ms_pegawai_id')
        //     ->join('ms_pegawai_akun as mpa', 'mp.id', '=', 'mpa.ms_pegawai_id')
        //     ->where('mpa.id', \Illuminate\Support\Facades\Auth::guard('pegawai')->id())
        //     ->select('mc.id', 'mc.nama')
        //     ->get();

        // $akses_cabang = \Illuminate\Support\Facades\DB::table('hak_akses_pegawai_cabang as hapc')
        //     ->join('ms_cabang as mc', 'hapc.ms_cabang_id', '=', 'mc.id')
        //     ->join('ms_pegawai as mp', 'mp.id', '=', 'hapc.ms_pegawai_id')
        //     ->join('ms_pegawai_akun as mpa', 'mp.id', '=', 'mpa.ms_pegawai_id')
        //     ->where('mpa.id', \Illuminate\Support\Facades\Auth::guard('pegawai')->id())
        //     ->select('mc.id', 'mc.nama')
        //     ->get();

        // if ($akses_cabang->isEmpty()) {
        //     abort(403, 'Tidak memiliki akses cabang');
        // }

        // $akses_gudang = \Illuminate\Support\Facades\DB::table('ms_gudang')
        //     ->whereIn('ms_cabang_id', $akses_cabang->pluck('id')->toArray())
        //     ->get();

        // if ($akses_gudang->isEmpty()) {
        //     abort(403, 'Tidak memiliki akses gudang');
        // }

        // dd($akses_cabang, $akses_gudang);
    }

    public function render()
    {

        return view('livewire.welcome', [
            'users' => $this->users(),
            'headers' => $this->headers()
        ]);
    }
}
