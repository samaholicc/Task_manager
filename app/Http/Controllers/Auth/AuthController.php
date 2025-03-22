<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use SendsPasswordResetEmails, ResetsPasswords {
        // Resolve credentials method conflict
        SendsPasswordResetEmails::credentials insteadof ResetsPasswords;
        ResetsPasswords::credentials as resetCredentials;

        // Resolve broker method conflict
        SendsPasswordResetEmails::broker insteadof ResetsPasswords;
        ResetsPasswords::broker as resetBroker;
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('my_tasks');
        }

        return back()->withErrors(['email' => 'Les identifiants sont incorrects.']);
    }

    // Show the registration form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('my_tasks');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    // Show the password reset request form
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    // Show the password reset form (after clicking the link in the email)
    public function showResetForm(Request $request, $token = null)
    {
        // Validate that the token is present
        if (!$token) {
            return redirect()->route('password.request')
                ->withErrors(['token' => 'Le jeton de réinitialisation est manquant ou invalide. Veuillez réessayer.']);
        }

        // Validate that the email is present in the query string
        $email = $request->query('email');
        if (!$email) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'L\'adresse email est manquante. Veuillez réessayer.']);
        }

        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $email]
        );
    }

    // Redirect after successful password reset
    protected function redirectTo()
    {
        return route('my_tasks');
    }

    // Override sendResetLinkEmail to ensure it uses the correct credentials method
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        // Use the default credentials method (from SendsPasswordResetEmails)
        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == \Illuminate\Support\Facades\Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }

    // Override reset to ensure it uses the correct credentials method
    public function reset(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        // Use the aliased resetCredentials method (from ResetsPasswords)
        $response = $this->broker()->reset(
            $this->resetCredentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        return $response == \Illuminate\Support\Facades\Password::PASSWORD_RESET
            ? $this->sendResetResponse($request, $response)
            : $this->sendResetFailedResponse($request, $response);
    }
}