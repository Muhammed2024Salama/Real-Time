<?php

namespace App\Http\Controllers\Auth;

use App\Events\NewUserRegisteredEvent;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Notifications\NewUserRegisteredNotifications;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        /**
         * Send Notification To Admin
         */
         $admin = Admin::find(1);
         // $admin->notify(new NewUserRegisteredNotifications($user));
         Notification::send($admin, new NewUserRegisteredNotifications($user));

        // $admins = Admin::all();
        // Notification::send(Admin::all(), new NewUserRegisteredNotifications($user));


        /**
         * Pusher Event Broadcast
         * To Run An Event NewUserRegisteredEvent::dispatch();
         */
        NewUserRegisteredEvent::dispatch($user);
        // Or
        // Broadcast(new NewUserRegisteredEvent());

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
