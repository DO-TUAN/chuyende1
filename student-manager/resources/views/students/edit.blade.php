<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">Chỉnh Sửa Thông Tin Sinh Viên</h4>
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

                    <form action="{{ route('students.update', $student->id) }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Họ và tên:</label>
                            <input type="text" name="name" id="name" class="form-control" 
                                   value="{{ old('name', $student->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="major" class="form-label">Ngành học:</label>
                            <input type="text" name="major" id="major" class="form-control" 
                                   value="{{ old('major', $student->major) }}" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('students.index') }}" class="btn btn-secondary">Hủy bỏ</a>
                            <button type="submit" class="btn btn-primary">Cập nhật dữ liệu</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>