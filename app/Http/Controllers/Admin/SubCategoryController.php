<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    function index(): View
    {
        $sub_categories = SubCategory::latest()->get();
        return view('admin.sub-category.index', compact('sub_categories'));
    }
    function create(): View
    {
        $categories = Category::latest()->get();
        return view('admin.sub-category.create', compact('categories'));
    }
    function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:sub_categories',
            'cat_id' => 'required|exists:categories,id'
        ]);

        $sub_category = new SubCategory();
        $sub_category->name = $request->name;
        $sub_category->slug = Str::slug($request->name);
        $sub_category->cat_id = $request->cat_id;
        $sub_category->save();
        return redirect()->route('admin.sub-category.index')->with('success', 'Thêm danh mục con thành công');
    }
    function edit($id): View
    {
        $sub_category = SubCategory::findOrFail($id);
        $categories = Category::latest()->get();
        return view('admin.sub-category.update', compact('sub_category', 'categories'));
    }
    function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'cat_id' => 'required|exists:categories,id'
        ]);

        $sub_category = SubCategory::findOrFail($id);
        $sub_category->name = $request->name;
        $sub_category->slug = Str::slug($request->name);
        $sub_category->cat_id = $request->cat_id;
        $sub_category->save();
        return redirect()->route('admin.sub-category.index')->with('success', 'Cập nhật danh mục phụ thành công');
    }
    function delete($id): RedirectResponse
    {
        SubCategory::findOrFail($id)->delete();
        return redirect()->route('admin.sub-category.index')->with('success', 'Xóa danh mục phụ thành công');
    }

    function update_status($id): RedirectResponse
    {
        $sub_category = SubCategory::findOrFail($id);
        if ($sub_category->status == 1) {
            $sub_category->status = 0;
            $sub_category->save();

            return redirect()->route('admin.sub-category.index')->with('success', 'Đã ẩn danh mục phụ');
        } else {
            $sub_category->status = 1;
            $sub_category->save();
            return redirect()->route('admin.sub-category.index')->with('success', 'Đã hiển thị danh mục phụ');
        }
    }
}
