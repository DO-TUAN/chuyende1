<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Hiển thị danh sách (kèm Tìm kiếm, Sắp xếp, Phân trang)
    public function index(Request $request)
    {
        // Bắt đầu query và sử dụng with() để tránh lỗi N+1
        $query = Product::with('category');

        // Chức năng tìm kiếm theo tên
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Chức năng sắp xếp theo giá
        if ($request->has('sort')) {
            $direction = $request->sort == 'asc' ? 'asc' : 'desc';
            $query->orderBy('price', $direction);
        } else {
            $query->latest(); // Mặc định xếp mới nhất lên đầu
        }

        // Phân trang
        $products = $query->paginate(10);

        return view('products.index', compact('products'));
    }

    // Hiển thị form thêm mới
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // Xử lý lưu dữ liệu thêm mới
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Xử lý upload ảnh
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công!');
    }
// Hiển thị form sửa sản phẩm
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    // Xử lý cập nhật dữ liệu
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            // Lưu ảnh mới
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    // Xử lý xóa sản phẩm
    public function destroy(Product $product)
    {
        // Xóa file ảnh trong ổ cứng trước khi xóa data
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Đã xóa sản phẩm!');
    }
}