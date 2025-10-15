{{-- resources/views/products/_form.blade.php --}}

<div style="margin-bottom: 15px;">
    <label for="name" style="display: block; margin-bottom: 5px; font-weight: bold;">Tên Sản phẩm <span style="color: red;">*</span></label>
    <x-input name="name" :value="$product->name" required />
</div>

<div style="margin-bottom: 15px;">
    <label for="price" style="display: block; margin-bottom: 5px; font-weight: bold;">Giá <span style="color: red;">*</span></label>
    {{-- Sử dụng type="number" cho giá --}}
    <x-input name="price" type="number" :value="$product->price" required step="0.01" />
</div>

<div style="margin-bottom: 15px;">
    <label for="category_id" style="display: block; margin-bottom: 5px; font-weight: bold;">Danh mục <span style="color: red;">*</span></label>
    <select name="category_id" id="category_id" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
        <option value="">-- Chọn Danh mục --</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <p style="color: red; font-size: 0.9em; margin-top: 4px;">{{ $message }}</p>
    @enderror
</div>

{{-- Thêm trường mô tả (nếu cần theo yêu cầu bài cũ) --}}
{{-- <div style="margin-bottom: 15px;">
    <label for="description" style="display: block; margin-bottom: 5px; font-weight: bold;">Mô tả</label>
    <textarea name="description" id="description" rows="4" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">{{ old('description', $product->description) }}</textarea>
</div> --}}
