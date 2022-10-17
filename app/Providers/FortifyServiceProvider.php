<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Spatie\Activitylog\Models\Activity;
use Request as Requestip;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        // Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email . $request->ip());
        });

        // RateLimiter::for('two-factor', function (Request $request) {
        //     return Limit::perMinute(5)->by($request->session()->get('login.id'));
        // });

        Fortify::authenticateUsing(function (Request $request) {
            // Validator::make($request->all(), [
            //     'g-recaptcha-response' => 'required|captcha'
            // ])->validate();
            $user = User::where('email', $request->email)->first();
          
            
            if ($user && Hash::check($request->password, $user->password)) {
                activity()
                    ->performedOn($user)
                    ->causedBy($user)
                    ->tap(function (Activity $activity) {
                        $activity->ip = Requestip::ip();
                        $activity->log_name = 'user';
                    })
                    ->log($user->name . ' Melakukan Login');
                $lastLoggedActivity = Activity::all()->last();

                $lastLoggedActivity->log_name; //returns an instance of an eloquent model
                $lastLoggedActivity->subject; //returns an instance of an eloquent model
                $lastLoggedActivity->causer; //returns an instance of your user model
                $lastLoggedActivity->description; //returns 'Look, I logged something'
                $lastLoggedActivity->ip; // returns 'my special value'
                return $user;
                
            }
        });
    }
}
