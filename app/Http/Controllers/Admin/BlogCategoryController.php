<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Str;

class BlogCategoryController extends Controller
{
    function index(): View
    {
        $blog_categories = BlogCategory::latest()->get();
        return view('admin.blog-category.index', compact('blog_categories'));
    }
    function create(): View
    {
        return view('admin.blog-category.create');
    }
    function store(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required|unique:blog_categories',
        ]);
        BlogCategory::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
        ]);
        return redirect()->route('admin.blog-category.index')->with('success', 'Thêm danh mục Blog thành công');
    }
    function edit($id): View
    {
        $blog_category = BlogCategory::findOrFail($id);
        return view('admin.blog-category.update', compact('blog_category'));
    }
    function update(Request $request, $id): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
        ]);
        BlogCategory::where('id', $id)->update([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
        ]);
        return redirect()->route('admin.blog-category.index')->with('success', 'Cập nhật danh mục Blog thành công');
    }
    function delete($id): RedirectResponse
    {
        BlogCategory::findOrFail($id)->delete();
        return redirect()->route('admin.blog-category.index')->with('success', 'Xóa danh mục Blog thành công');
    }

    function update_status($id): RedirectResponse
    {
        $blog_category = BlogCategory::findOrFail($id);
        if ($blog_category->status == 1) {
            $blog_category->status = 0;
            $blog_category->save();

            return redirect()->route('admin.blog-category.index')->with('success', 'Đã tắt trạng thái danh mục Blog thành công');
        } else {
            $blog_category->status = 1;
            $blog_category->save();

            return redirect()->route('admin.blog-category.index')->with('success', 'Đã kích hoạt trạng thái danh mục Blog thành công');
        }
    }
}
