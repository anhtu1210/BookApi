<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Validation
{
    public function handle(Request $request, Closure $next)
    {
        // Lấy ngôn ngữ từ request và thiết lập
        $lang = $request->header('lang', 'en'); // Mặc định là 'en'
        app()->setLocale($lang);

        // Các rule để validate
        $rules = [
            'title' => 'required',
            'author' => 'required',
            'published_year' => 'required|integer',
            'code' => 'required|unique:books',
        ];

        // Tạo validator và validate dữ liệu
        $validator = Validator::make($request->all(), $rules);

        // Kiểm tra nếu có lỗi validate
        if ($validator->fails()) {
            // Trả về thông báo lỗi dạng JSON
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Nếu không có lỗi, tiếp tục xử lý request
        return $next($request);
    }
}
