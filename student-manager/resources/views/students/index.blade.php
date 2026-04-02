<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .table-container { background: white; border-radius: 15px; padding: 20px; shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .btn-add { margin-bottom: 20px; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="table-container shadow-sm">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary fw-bold"> <i class="fas fa-graduation-cap"></i> Danh Sách Sinh Viên</h2>
            <a href="{{ route('students.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Thêm sinh viên mới
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" style="width: 10%">ID</th>
                        <th scope="col" style="width: 40%">Họ Tên</th>
                        <th scope="col" style="width: 30%">Ngành Học</th>
                        <th scope="col" style="width: 20%" class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td><strong>#{{ $student->id }}</strong></td>
                        <td>{{ $student->name }}</td>
                        <td>
                            <span class="badge bg-info text-dark">{{ $student->major }}</span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-outline-warning btn-sm">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                                
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?')">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm ms-1">
                                        <i class="fas fa-trash-alt"></i> Xóa
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($students->isEmpty())
            <div class="text-center py-4">
                <p class="text-muted">Chưa có sinh viên nào trong danh sách.</p>
            </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>