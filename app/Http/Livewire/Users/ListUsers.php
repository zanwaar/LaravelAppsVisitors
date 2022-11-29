<?php

namespace App\Http\Livewire\Users;


use App\Http\Livewire\AppComponent;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Spatie\Activitylog\Models\Activity;
use Request as Requestip;

class ListUsers extends AppComponent
{
	use WithFileUploads;
	use AuthorizesRequests;

	public $state = [];

	public $user;

	public $showEditModal = false;

	public $userIdBeingRemoved = null;

	public $searchTerm = null;

	protected $queryString = ['searchTerm' => ['except' => '']];

	public $photo;

	public $sortColumnName = 'created_at';

	public $sortDirection = 'desc';

	public function mount()
	{
		$this->authorize('admin');
	}
	public function changeRole(User $user, $role)
	{

		Validator::make(['role' => $role], [
			'role' => [
				'required',
				Rule::in(User::ROLE_ADMIN, User::ROLE_OPERATOR),
			],
		])->validate();

		DB::table('model_has_roles')->where('model_id', $user->id)->delete();
		$user->assignRole($role);
		$this->dispatchBrowserEvent('alert', ['message' => "Role changed to {$role} successfully."]);

		activity()
			->performedOn(auth()->user())
			->causedBy(auth()->user())
			->tap(function (Activity $activity) {
				$activity->ip = Requestip::ip();
				$activity->log_name = 'role';
			})
			->log(auth()->user()->name . ' Melakukan Update ' . $user->name . ' ke Role ' . $role);
		$lastLoggedActivity = Activity::all()->last();

		$lastLoggedActivity->log_name; //returns an instance of an eloquent model
		$lastLoggedActivity->subject; //returns an instance of an eloquent model
		$lastLoggedActivity->causer; //returns an instance of your user model
		$lastLoggedActivity->description; //returns 'Look, I logged something'
		$lastLoggedActivity->ip; // returns 'my special value'
	}

	public function addNew()
	{
		$this->reset();

		$this->showEditModal = false;

		$this->dispatchBrowserEvent('show-form');
	}

	public function createUser()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
			'email' => 'required|email|unique:users',
			'password' => 'required|confirmed',
		])->validate();

		$validatedData['password'] = bcrypt($validatedData['password']);

		if ($this->photo) {
			$validatedData['avatar'] = $this->photo->store('/', 'avatars');
		}

		$user = User::create($validatedData);
		$user->assignRole('operator');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'User added successfully!']);

		activity()
			->performedOn(auth()->user())
			->causedBy(auth()->user())
			->tap(function (Activity $activity) {
				$activity->ip = Requestip::ip();
				$activity->log_name = 'user';
			})
			->log(auth()->user()->name . ' Melakukan Tambah User Baru ' . $user->name);
		$lastLoggedActivity = Activity::all()->last();

		$lastLoggedActivity->log_name;
		$lastLoggedActivity->subject;
		$lastLoggedActivity->causer;
		$lastLoggedActivity->description;
		$lastLoggedActivity->ip;
	}

	public function edit(User $user)
	{
		$this->reset();

		$this->showEditModal = true;

		$this->user = $user;

		$this->state = $user->toArray();

		$this->dispatchBrowserEvent('show-form');
	}

	public function updateUser()
	{

		$validatedData = Validator::make($this->state, [
			'name' => 'required',
			'email' => 'required|email|unique:users,email,' . $this->user->id,
			'password' => 'sometimes|confirmed',
		])->validate();

		if (!empty($validatedData['password'])) {
			$validatedData['password'] = bcrypt($validatedData['password']);
		}

		if ($this->photo) {
			Storage::disk('avatars')->delete($this->user->avatar);
			$validatedData['avatar'] = $this->photo->store('/', 'avatars');
		}

		$this->user->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'User updated successfully!']);

		activity()
			->performedOn(auth()->user())
			->causedBy(auth()->user())
			->tap(function (Activity $activity) {
				$activity->ip = Requestip::ip();
				$activity->log_name = 'user';
			})
			->log(auth()->user()->name . ' Melakukan updated User ' . $this->user->name);
		$lastLoggedActivity = Activity::all()->last();

		$lastLoggedActivity->log_name;
		$lastLoggedActivity->subject;
		$lastLoggedActivity->causer;
		$lastLoggedActivity->description;
		$lastLoggedActivity->ip;
	}

	public function confirmUserRemoval($user)
	{
		$this->userIdBeingRemoved = $user['id'];

		$this->dispatchBrowserEvent('show-delete-modal');
	}

	public function deleteUser()
	{
		$user = User::findOrFail($this->userIdBeingRemoved);

		$user->delete();

		$this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'User deleted successfully!']);

		activity()
			->performedOn(auth()->user())
			->causedBy(auth()->user())
			->tap(function (Activity $activity) {
				$activity->ip = Requestip::ip();
				$activity->log_name = 'user';
			})
			->log(auth()->user()->name . ' Melakukan hapus User ' . $user->name);
		$lastLoggedActivity = Activity::all()->last();

		$lastLoggedActivity->log_name;
		$lastLoggedActivity->subject;
		$lastLoggedActivity->causer;
		$lastLoggedActivity->description;
		$lastLoggedActivity->ip;
	}

	public function sortBy($columnName)
	{
		if ($this->sortColumnName === $columnName) {
			$this->sortDirection = $this->swapSortDirection();
		} else {
			$this->sortDirection = 'asc';
		}

		$this->sortColumnName = $columnName;
	}

	public function swapSortDirection()
	{
		return $this->sortDirection === 'asc' ? 'desc' : 'asc';
	}

	public function updatedSearchTerm()
	{
		$this->resetPage();
	}

	public function render()
	{
		$id = Auth::user()->getAuthIdentifier();
		$users = User::latest()->with(['roles'])
			->orwhere('name', 'like', '%' . $this->searchTerm . '%')
			->orWhere('email', 'like', '%' . $this->searchTerm . '%')
			->orderBy($this->sortColumnName, $this->sortDirection)
			->paginate($this->trow);
		// $role = $users->roles;

		return view('livewire.users.list-users', [
			'users' => $users,
		]);
	}
}
