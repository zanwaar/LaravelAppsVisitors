<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Models\Client;
use Livewire\Component;
use App\Models\Appointment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CreateAppointmentForm extends Component
{
	use AuthorizesRequests;
	public $state = [
		'status' => 'SCHEDULED',
		'order_position' => 0,
	];

	public function createAppointment()
	{
		// $this->authorize('my-permission');
		Validator::make(
			$this->state,
			[
				'client_id' => 'required',
				// 'members' => 'required',
				// 'color' => 'required',
				// 'date' => 'required',
				// 'time' => 'required',
				// 'note' => 'nullable',
				'status' => 'required|in:SCHEDULED,CLOSED',
			],
			[
				'client_id.required' => 'The client field is required.'
			]
		)->validate();

		Appointment::create($this->state);

		$this->dispatchBrowserEvent('alert', ['message' => 'Appointment created successfully!']);

		return redirect()->route('appointments');
	}

	public function render()
	{
		$clients = Client::all();

		return view('livewire.admin.appointments.create-appointment-form', [
			'clients' => $clients,
		]);
	}
}
