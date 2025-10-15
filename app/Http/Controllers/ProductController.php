<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * Cập nhật để hỗ trợ lọc theo giá và danh mục.
     */
    public function index(Request $request)
    {
        // 1. Chuẩn bị truy vấn gốc
        $query = Product::with('category');

        // Lấy tất cả danh mục kèm theo số lượng sản phẩm (Yêu cầu nâng cao 2)
        $categoriesWithCount = Category::withCount('products')->get();

        // 2. Xử lý Lọc theo Giá (filter)
        $currentFilter = $request->query('filter'); // Lấy tham số filter từ URL

        if ($currentFilter === 'expensive') {
            // Lọc: Sản phẩm có giá > 100000
            $query->where('price', '>', 100000);
        }

        // 3. Xử lý Lọc theo Danh mục (category_id)
        $currentCategory = $request->query('category_id'); // Lấy tham số category_id từ URL

        if ($currentCategory && $currentCategory !== 'all') {
            // Lọc: Sản phẩm thuộc danh mục được chọn
            $query->where('category_id', $currentCategory);
        }

        // 4. Phân trang và thực thi truy vấn
        $products = $query->paginate(10);

        // 5. Truyền dữ liệu bổ sung sang View
        return view('products.index', compact(
            'products',
            'categoriesWithCount',
            'currentFilter',
            'currentCategory'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Truyền danh sách Category để người dùng chọn
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ], [
            'name.required' => 'Tên sản phẩm là bắt buộc.',
            'name.unique' => 'Tên sản phẩm đã tồn tại.',
            'price.required' => 'Giá là bắt buộc.',
            'price.numeric' => 'Giá phải là số.',
            'category_id.required' => 'Vui lòng chọn danh mục.',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
                         ->with('success', 'Thêm sản phẩm thành công!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Dòng này cần Product Model để hoạt động.
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Thêm dòng này để tìm sản phẩm dựa trên $id
        $product = Product::findOrFail($id);

        $categories = Category::all();
        // Bây giờ $product đã tồn tại và được truyền vào view
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            // Bỏ qua tên của sản phẩm hiện tại khi kiểm tra unique
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ], [
            'name.unique' => 'Tên sản phẩm đã tồn tại.',
            // ... (thông báo lỗi khác)
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')
                         ->with('success', 'Cập nhật sản phẩm thành công!');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
                         ->with('success', 'Xóa sản phẩm thành công!');
    }

    // Phương thức này hiện tại không cần dùng để hiển thị trên UI,
    // ta đã tích hợp logic vào index()
    // public function advancedQueries()
    // {
    //     // ... (Code đã bị comment/xóa để tránh xung đột)
    // }
}
