<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class   UserAuthController extends Controller
{

    public function get_all(): \Illuminate\Database\Eloquent\Collection|array
    {
        return User::with(['houses'])->get();
    }

    //
    public function login_cpanel(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required'],
        ]);
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            $token = $user->createToken(time())->plainTextToken;

            $access = ['cPanel'];
            session([
                'access' => $access,
                'user_id' => $user->id
            ]);
            $data = [
                'message' => 'attempt login successful',
                'token' => $token,
                'user' => $user
            ];
            return response()->json($data);
        } else {
            $email = $request->email
                ? 'email et incorrect'
                : 'Le champ email et requis ';
            $password = !$request->password
                ? 'Le champ mode de passe et requis'
                : null;
            $data = [
                'password' => [$password],
                'email' => [$email],
            ];
            return response()->json($data, 422);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required' ], // 'phone:US,CA'
            'password' => ['required', 'confirmed', Password::default()],
            'password_confirmation' => ['required', 'same:password'],
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'type' => "broker",
                'phone' => $request->phone,
                'password' => $request->password,
            ]);
            DB::commit();
            return  response()->json(['success' => true]);
        }catch (\Exception $exception){
            DB::rollBack();
        }

    }

    public function logout(Request $request): bool|JsonResponse
    {
        $user = Auth::user();
        if (!$user) return true;
        $user->tokens()->delete();
        Auth::logout();

        $request->session()->flush();
        $request->session()->forget(['tenant', 'access', 'user_id']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'status' => 200,
            'message' => "ok"
        ]);
    }

    // create function to update user profile
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $image_base64 = base64_encode(file_get_contents($image));
            $user->avatar = $image_base64;
        }
        if ($request->password) {
            $request->validate([
                'old_password' => ['required'],
            ]);
            if (Hash::check($request->old_password, $user->password)) {
                $request->validate([
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]);
                $user->password = ($request->password);
            } else {
                return response()->json([
                    'status' => 422,
                    'message' => 'Le mot de passe actuel est incorrect',
                    'errors' => [
                        'old_password' => ['Le mot de passe actuel est incorrect']
                    ]
                ], 422);
            }

        }

        $user->name = $request->name;
        $user->phone = $request->phone;


        $user->save();

        return response()->json([
            'status' => 200,
            'message' => "ok"
        ]);
    }

}
