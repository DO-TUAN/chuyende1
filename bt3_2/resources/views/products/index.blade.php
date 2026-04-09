@extends('layout.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Danh sách sản phẩm</h2>
    <a href="{{ route('products.create') }}" class="btn btn-primary">Thêm sản phẩm</a>
</div>

<form action="{{ route('products.index') }}" method="GET" class="row g-3 mb-4">
    <div class="col-md-4">
        <input type="text" name="search" class="form-control" placeholder="Tìm tên sản phẩm..." value="{{ request('search') }}">
    </div>
    <div class="col-md-3">
        <select name="sort" class="form-select">
            <option value="">Sắp xếp theo giá</option>
            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Giá tăng dần</option>
            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Giá giảm dần</option>
        </select>
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-secondary">Lọc dữ liệu</button>
    </div>
</form>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Danh mục</th>
            <th>Giá</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" width="60" height="60" style="object-fit: cover;" alt="Ảnh SP">
                    @else
                        <span>Không có ảnh</span>
                    @endif
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name ?? 'N/A' }}</td>
                <td>{{ number_format($product->price, 0, ',', '.') }} VNĐ</td>
               <td>
    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Sửa</a>
    
    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
    </form>
</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">Chưa có sản phẩm nào.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="d-flex justify-content-center mt-3">
    {{ $products->links() }}
</div>
@endsection