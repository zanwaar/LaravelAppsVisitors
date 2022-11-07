<?php

namespace App\Http\Livewire\Settings;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateSetting extends Component
{
    use WithFileUploads;
    public $state = [];
    public $logo;

    public function mount()
    {
        $setting = Setting::first();

        if ($setting) {
            $this->state = $setting->toArray();
        }
    }

    public function updateSetting()
    {
        $setting = Setting::first();

        if ($this->logo) {
            Storage::disk('images')->delete($setting->site_logo);
            $this->state['site_logo'] = $this->logo->store('/', 'images');
        }

        if ($setting) {
            $setting->update($this->state);
        } else {
            Setting::create($this->state);
        }


        Cache::forget('setting');

        $this->dispatchBrowserEvent('alert', ['message' => 'Settings updated successfully!']);
    }

    public function render()
    {
        return view('livewire.settings.update-setting');
    }
}
