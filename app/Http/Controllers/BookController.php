<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BookController extends Controller
{
    public function index()
    {
        // Cache dữ liệu trong 60 phút
        $books = Cache::remember('books', 60, function () {
            return Book::all();
        });

        if ($books->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Không có book nào.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Lấy danh sách book thành công.',
            'data' => $books
        ], 200);
    }
    
    public function store(Request $request)
    {
        // validate
        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'published_year' => 'required|integer',
            'isbn' => 'required|unique:books'
        ]);

        // tạo item mới
        try {
            $books = Book::create($request->all());
            Cache::forget('books'); // Xóa cache
            return response()->json([
                'success' => true,
                'message' => 'Tạo books thành công.',
                'data' => $books
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi tạo books.'
            ], 500);
        }
    }
    public function show($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy book.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Lấy chi tiết book thành công.',
            'data' => $book
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $book = Book::query()->find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy book để cập nhật.'
            ], 404);
        }

        // Cập nhật book
        try {
            $book->update($request->all());
            Cache::forget('books'); // Xóa cache
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật book thành công.',
                'data' => $book
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi cập nhật book.'
            ], 500);
        }
    }
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy book để xóa.'
            ], 404);
        }

        try {
            $book->delete();
            Cache::forget('books'); // Xóa cache
            return response()->json([
                'success' => true,
                'message' => 'Xóa book thành công.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi xóa book.'
            ], 500);
        }
    }
}
