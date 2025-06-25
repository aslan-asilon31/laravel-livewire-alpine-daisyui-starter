<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Livewire\Attributes\Computed;

class Users extends Component
{
	use WithPagination;

	protected $title = 'User';
	protected $url = '/user';
	protected $paginationTheme = 'bootstrap';
	public $selected_id, $keyWord, $name, $email;

	#[Computed]
	public function filteredUsers()
	{
		$keyWord = '%' . $this->keyWord . '%';
		return User::latest()
			->where(function ($query) use ($keyWord) {
				$query
					->orWhere('name', 'LIKE', $keyWord)
					->orWhere('email', 'LIKE', $keyWord);
			})
			->paginate(10);
	}

	public function mount() {}

	public function render()
	{
		return view('livewire.users.view', [
			'users' => $this->filteredUsers,
			'selected_id' => $this->selected_id,
		])->title($this->title)
			->layout('components.layouts.app');
		// return view('livewire.users.view')->layout('components.layouts.app');
	}

	public function cancel()
	{
		$this->reset();
	}

	public function save()
	{
		$this->validate([
			'name' => 'required',
			'email' => 'required',
		]);

		User::updateOrCreate(
			['id' => $this->selected_id],
			[
				'name' => $this->name,
				'email' => $this->email
			]
		);

		$message = $this->selected_id ? 'User Successfully updated.' : 'User Successfully created.';
		$this->dispatch('closeModal');
		$this->reset();
		session()->flash('message', $message);
	}

	public function edit($id)
	{
		$this->selected_id = $id;
		$this->fill(User::findOrFail($id)->toArray());
	}

	public function destroy($id)
	{
		if ($id) {
			User::where('id', $id)->delete();
		}
	}
}
