<?php

namespace App\Livewire\HakAksesJabatan;

use App\Livewire\HakAksesJabatan\Forms\MsJabatanForm;
use Livewire\Component;
use App\Models\MsStatus;
use App\Models\HakAkses;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class HakAksesJabatanPerbaharui extends Component
{

  public function render()
  {
    return view('livewire.hak-akses-jabatan.hak-akses-jabatan-perbaharui')
      ->title($this->title);
  }

  use \Livewire\WithFileUploads;
  use \Mary\Traits\Toast;
  use \App\Helpers\FormHook\Traits\aksesOpsi;

  #[\Livewire\Attributes\Locked]
  public string $title = 'cabang';

  #[\Livewire\Attributes\Locked]
  public string $url = '/cabang';

  #[\Livewire\Attributes\Locked]
  private string $baseFolderName = '/files/images/cabang';

  #[\Livewire\Attributes\Locked]
  public string $id = '';

  #[\Livewire\Attributes\Locked]
  public string $hanyalihat = '';

  #[\Livewire\Attributes\Locked]
  public bool $isReadonly = false;

  #[\Livewire\Attributes\Locked]
  public bool $isDisabled = false;

  #[\Livewire\Attributes\Locked]
  public array $options = [];

  #[\Livewire\Attributes\Locked]
  protected $masterModel = \App\Models\MsJabatan::class;

  #[\Livewire\Attributes\Locked]
  public array $optionStatus = [];

  public MsJabatanForm $masterForm;

  public $isLoading = false;
  public  $groupedPermissions = [];
  public bool $checkAll = false;
  public $checkAction = false;
  public $permissionList = false;

  public $roles = [];
  public $rolePermissions = [];
  public $role;
  public $roleId;
  public $permissions;
  public $selectedPermissions = [];
  public $selectedStatusPermissions  = [];
  public $statuses;
  public $groupedByPrefix = [];
  public $subActionsByPermission = [];
  public array $checkAllByAction = [];
  public bool $checkAllSub = false;


  public function toggleCheckAllSub()
  {
    if (! $this->checkAllSub) {
      $this->selectedStatusPermissions = [];
      return;
    }

    $selectedStatusPermissions = [];

    foreach ($this->permissions as $permission) {
      foreach ($this->statuses as $status) {
        $selectedStatusPermissions[] = $permission->id . '_' . $status->id;
      }
    }

    $this->selectedStatusPermissions = $selectedStatusPermissions;
  }



  public function toggleCheckAll()
  {
    if ($this->checkAll) {
      $this->selectedPermissions = $this->permissions->pluck('id')->toArray();
    } else {
      $this->selectedPermissions = [];
    }
  }

  public function permissionList()
  {
    $this->permissionList = true;
  }

  public function groupPermissions()
  {
    $this->groupedPermissions = [];
    $this->groupedByPrefix = [];

    foreach ($this->permissions as $permission) {
      $parts = explode('-', $permission->nama);
      $group = $parts[0] ?? $permission->nama;
      $action = $parts[1] ?? null;

      if (!isset($this->groupedPermissions[$group])) {
        $this->groupedPermissions[$group] = [];
      }
      $this->groupedPermissions[$group][] = $permission;

      // Simpan berdasarkan prefix dan action tunggal
      if ($action) {
        if (!isset($this->groupedByPrefix[$group])) {
          $this->groupedByPrefix[$group] = [];
        }

        // Gunakan array jika ada kemungkinan duplikat nama
        if (!isset($this->groupedByPrefix[$group][$action])) {
          $this->groupedByPrefix[$group][$action] = $permission;
        }
      }
    }
  }


  public function mount()
  {

    if ($this->id && $this->hanyalihat) {
      $this->title .= ' (Lihat)';
      $this->lihat();
    } else if ($this->id) {
      $this->title .= ' (Edit)';
      $this->edit();
    } else {
      $this->title .= ' (Buat)';
      $this->buat();
    }

    $this->initialize();
  }

  public function initialize() {}

  public function buat()
  {
    $this->optionStatus = $this->aksesStatusOption();

    $this->masterForm->reset();
  }

  public function store()
  {
    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];


    \Illuminate\Support\Facades\DB::beginTransaction();
    try {

      $validatedForm['dibuat_oleh'] = \Illuminate\Support\Facades\Auth::guard('pegawai')->user()->nama;
      $validatedForm['diupdate_oleh'] = \Illuminate\Support\Facades\Auth::guard('pegawai')->user()->nama;

      $this->masterModel::create($validatedForm);
      \Illuminate\Support\Facades\DB::commit();
      $this->redirect('/cabang', true);
      $this->success('Data berhasil disimpan');
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      \Log::error('Data gagal disimpan: ' . $th->getMessage());

      $this->error('Data gagal disimpan');
    }
  }

  public function lihat()
  {
    dd('stop');
    $this->isReadonly = true;
    $this->isDisabled = true;
    $masterData = $this->masterModel::findOrFail($this->id);
    $this->masterForm->fill($masterData);
  }

  public function edit()
  {
    $this->role = \App\Models\MsJabatan::find($this->id);
    if (!$this->role) {
      $this->selectedPermissions = [];
      session()->flash('error', 'Role not found');
      return;
    }

    $this->permissions = HakAkses::all();
    $this->selectedPermissions = $this->role->hakAkses()->pluck('hak_akses.id')->toArray();

    $statusPivot = \App\Models\HakAksesJabatanStatus::with(['msStatus', 'hakAksesJabatan'])
      ->whereIn('hak_akses_jabatan_id', function ($query) {
        $query->select('id')
          ->from('hak_akses_jabatan')
          ->where('ms_jabatan_id', $this->role->id);
      })->get()
      ->map(function ($item) {
        $item->msStatus_nama = $item->msStatus->nama ?? null;
        $item->hak_akses_id = $item->hakAksesJabatan->hak_akses_id ?? null;
        return $item;
      });

    $this->subActionsByPermission = $statusPivot->groupBy(function ($item) {
      return $item->hakAksesJabatan->hak_akses_id ?? null;
    })->map(function ($group) {
      return $group->map(function ($item) {
        return [
          'ms_status_id' => $item->ms_status_id,
          'nama' => $item->msStatus->nama ?? null,
        ];
      })->toArray();
    })->toArray();

    $this->selectedStatusPermissions = $statusPivot->map(function ($item) {
      return "{$item->hak_akses_id}_{$item->ms_status_id}";
    })->toArray();

    $this->statuses = MsStatus::orderBy('nomor')->get();
    $this->groupPermissions();
    $this->isReadonly = false;
    $this->isDisabled = false;
    $masterData = $this->masterModel::findOrFail($this->id);
    $this->masterForm->fill($masterData);
  }

  public function update()
  {
    $this->masterForm->tgl_dibuat ?? now();
    $this->masterForm->tgl_diupdate ?? now();

    $this->masterForm->diupdate_oleh = Auth::guard('pegawai')->user()->msPegawai->nama ?? null;

    $validatedForm = $this->validate(
      $this->masterForm->rules(),
      [],
      $this->masterForm->attributes()
    )['masterForm'];
    $masterData = $this->masterModel::findOrFail($this->id);

    $this->masterForm->dibuat_oleh = \Illuminate\Support\Facades\Auth::guard('pegawai')->user()->msPegawai->nama;
    $this->masterForm->diupdate_oleh = \Illuminate\Support\Facades\Auth::guard('pegawai')->user()->msPegawai->nama;

    DB::beginTransaction();

    try {
      \App\Models\HakAksesJabatan::where('ms_jabatan_id', $this->id)->delete();
      $nomorAkhirHakAksesJabatan = \App\Models\HakAksesJabatan::max('nomor') ?? 0;
      foreach ($this->selectedPermissions ?? [] as $hakAksesId) {
        $nomorAkhirHakAksesJabatan++;

        \App\Models\HakAksesJabatan::create([
          'id' => Str::uuid(),
          'ms_jabatan_id' => $this->id,
          'hak_akses_id' => $hakAksesId,
          'nomor' => $nomorAkhirHakAksesJabatan + 1,
          'diupdate_oleh' => \Illuminate\Support\Facades\Auth::guard('pegawai')->user()->msPegawai->nama,
          'tgl_dibuat' => now(),
          'tgl_diupdate' => now(),
        ]);
      }

      \App\Models\HakAksesJabatanStatus::whereIn('hak_akses_jabatan_id', function ($query) {
        $query->select('id')
          ->from('hak_akses_jabatan')
          ->where('ms_jabatan_id', $this->id);
      })->delete();

      $aksesJabatan = \App\Models\HakAksesJabatan::where('ms_jabatan_id', $this->id)->get();
      $nomorAkhirHakAksesJabatanStatus = \App\Models\HakAksesJabatanStatus::max('nomor') ?? 0;

      foreach ($aksesJabatan as $item) {
        foreach ($this->selectedStatusPermissions ?? [] as $statusKey) {
          [$explodedHakAksesId, $ms_status_id] = explode('_', $statusKey);
          $nomorAkhirHakAksesJabatanStatus++;

          if ($item->hak_akses_id == $explodedHakAksesId) {
            \App\Models\HakAksesJabatanStatus::create([
              'id' => Str::uuid(),
              'hak_akses_jabatan_id' => $item->id,
              'ms_status_id' => $ms_status_id,
              'nomor' => $nomorAkhirHakAksesJabatanStatus,
              'tgl_dibuat' => now(),
              'tgl_diupdate' => now(),
              'diupdate_oleh' => \Illuminate\Support\Facades\Auth::guard('pegawai')->user()->msPegawai->nama,

            ]);
          }
        }
      }

      DB::commit();

      $validatedForm['diupdate_oleh'] = \Illuminate\Support\Facades\Auth::guard('pegawai')->user()->nama ?? null;

      $masterData->update($validatedForm);

      $this->success('Data berhasil diupdate');
      // $this->redirect('/cabang', true);
    } catch (\Throwable $e) {
      DB::rollBack();
      \Log::error('Gagal update hak akses: ' . $e->getMessage());
      $this->error('Terjadi kesalahan saat mengupdate data');
    }
  }



  public function hapus()
  {
    $masterData = $this->masterModel::findOrFail($this->id);

    \Illuminate\Support\Facades\DB::beginTransaction();
    try {

      $masterData->delete();
      \Illuminate\Support\Facades\DB::commit();
      $this->redirect('/cabang', true);

      $this->success('Data berhasil dihapus');
    } catch (\Throwable $th) {
      \Illuminate\Support\Facades\DB::rollBack();
      $this->error('Data gagal dihapus');
    }
  }
}
