<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Sử dụng middleware auth, ngoại trừ hàm login
        $this->middleware('auth:api', ['except' => ['login', 'refresh']]);
    }

    /**
     * Lấy JWT token dựa trên thông tin đăng nhập.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        // Lấy thông tin đăng nhập (email và password)
        $credentials = request(['email', 'password']);

        // Nếu thông tin không hợp lệ, trả về lỗi Unauthorized
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Thông tin sai'], 401);
        }

        // Trả về token nếu đăng nhập thành công
        return $this->respondWithToken($token);
    }

    /**
     * Lấy thông tin người dùng đã xác thực.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Đăng xuất người dùng (hủy token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Làm mới token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Cấu trúc trả về của token.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user(),
        ]);
    }
}
