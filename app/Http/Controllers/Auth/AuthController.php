<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            if (!$user->is_active) {
                Auth::logout();
                return back()->with('error', 'Your account has been deactivated. Please contact administrator.');
            }

            $request->session()->regenerate();

            return $this->redirectBasedOnRole($user);
        }

        return back()->with('error', 'Invalid email or password.')->withInput();
    }

    /**
     * Show registration form
     */
    public function showRegisterForm()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }
        return view('auth.register');
    }

    /**
     * Handle registration request
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default role
            'is_active' => true,
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Registration successful! Welcome to Ibn Sina Foundation.');
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }

    /**
     * Redirect user based on their role
     */
    private function redirectBasedOnRole($user)
    {
        if ($user->role === 'superadmin' || $user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Welcome back, ' . $user->name . '!');
        }

        // Regular users go to user dashboard
        return redirect()->route('user.dashboard')->with('success', 'Welcome back, ' . $user->name . '!');
    }

    /**
     * Show forgot password form
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send password reset link
     */
    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::where('email', $request->email)->first();
        
        // Generate password reset token
        $token = Hash::make($user->email . now());
        $token = str_replace(['/', '$', '.'], '', $token); // Clean token for URL
        
        // Store token in session (in production, use database table)
        session([
            'password_reset_' . $token => [
                'email' => $user->email,
                'expires_at' => now()->addHour(),
            ]
        ]);

        // Generate reset URL
        $resetUrl = route('password.reset', $token);

        try {
            // Send email
            Mail::to($user->email)->send(new PasswordResetMail($user, $resetUrl));
            
            return back()->with('success', 'Password reset link has been sent to your email address. Please check your inbox.');
        } catch (\Exception $e) {
            \Log::error('Password reset email failed: ' . $e->getMessage());
            
            // Still provide the link as fallback
            return redirect()->route('password.reset', $token)
                ->with('success', 'Please use this link to reset your password: (Email sending failed, but you can still reset your password)');
        }
    }

    /**
     * Show reset password form
     */
    public function showResetPasswordForm($token)
    {
        $resetData = session('password_reset_' . $token);
        
        if (!$resetData || now()->gt($resetData['expires_at'])) {
            return redirect()->route('password.request')
                ->with('error', 'This password reset link has expired. Please request a new one.');
        }

        return view('auth.reset-password', compact('token'));
    }

    /**
     * Reset password
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $resetData = session('password_reset_' . $request->token);
        
        if (!$resetData || now()->gt($resetData['expires_at'])) {
            return redirect()->route('password.request')
                ->with('error', 'This password reset link has expired.');
        }

        $user = User::where('email', $resetData['email'])->first();
        
        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // Clear the reset token
        session()->forget('password_reset_' . $request->token);

        return redirect()->route('login')
            ->with('success', 'Your password has been reset successfully. Please login with your new password.');
    }

    /**
     * Show change password form (for authenticated users)
     */
    public function showChangePasswordForm()
    {
        return view('auth.change-password');
    }

    /**
     * Change password (for authenticated users)
     */
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect.');
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Your password has been changed successfully.');
    }
}

