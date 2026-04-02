<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
   // Hiển thị danh sách
    public function index() {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    // Form thêm mới
    public function create() {
        return view('students.create');
    }

    // Lưu dữ liệu
 public function store(Request $request) 
{
    // Kiểm tra dữ liệu
    $request->validate([
        // 'regex:/^[\pL\s]+$/u' cho phép chữ cái có dấu và khoảng trắng
        'name' => 'required|min:2|regex:/^[\pL\s]+$/u',
        'major' => 'required',
    ], [
        // Tùy chỉnh thông báo lỗi tiếng Việt
        'name.required' => 'Bạn chưa nhập tên sinh viên.',
        'name.regex' => 'Tên sinh viên chỉ được phép chứa chữ cái và khoảng trắng.',
        'name.min' => 'Tên phải có ít nhất 2 ký tự.',
        'major.required' => 'Vui lòng chọn ngành học.',
    ]);

    // Nếu dữ liệu hợp lệ, tiến hành lưu
    \App\Models\Student::create($request->all());

    return redirect()->route('students.index')->with('success', 'Thêm sinh viên thành công!');
}
    // Hiển thị form sửa
public function edit($id) {
    $student = \App\Models\Student::findOrFail($id);
    return view('students.edit', compact('student'));
}

// Xử lý cập nhật dữ liệu
public function update(Request $request, $id) {
    $request->validate([
        'name' => 'required',
        'major' => 'required',
    ]);

    $student = \App\Models\Student::findOrFail($id);
    $student->update($request->all());

    return redirect()->route('students.index')->with('success', 'Cập nhật thành công!');
}

// Xử lý xóa sinh viên
public function destroy($id) {
    $student = \App\Models\Student::findOrFail($id);
    $student->delete();

    return redirect()->route('students.index')->with('success', 'Xóa thành công!');
}
}
