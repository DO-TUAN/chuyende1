<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sinh viên mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Thêm Sinh Viên Mới</h4>
                </div>
                <div class="card-body">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('students.store') }}" method="POST">
                        @csrf <div class="mb-3">
                            <label for="name" class="form-label">Họ và tên:</label>
                            <input type="text" name="name" id="name" class="form-control" 
                                   placeholder="Ví dụ: Nguyễn Văn A" value="{{ old('name') }}" required>
                            <small class="text-muted">Lưu ý: Tên chỉ được chứa chữ cái.</small>
                        </div>

                        <div class="mb-3">
                            <label for="major" class="form-label">Ngành học:</label>
                            <input type="text" name="major" id="major" class="form-control" 
                                   placeholder="Ví dụ: Công nghệ thông tin" value="{{ old('major') }}" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('students.index') }}" class="btn btn-secondary">Quay lại</a>
                            <button type="submit" class="btn btn-success">Lưu sinh viên</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>