<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('media'), $fileName);

            $url = asset('media/' . $fileName);

            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
    function index(): View
    {
        $faqs = Faq::latest()->get();
        return view('admin.faq.index', compact('faqs'));
    }
    function create(): View
    {
        $faq_categories=FaqCategory::latest()->get();
        return view('admin.faq.create',compact('faq_categories'));
    }
    function store(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'title' => 'required',
            'cat_id' => 'required',
            'details' => 'required',
        ]);
        Faq::create($validate);
        return redirect()->route('admin.faq.index')->with('success', 'Thêm câu hỏi thường gặp thành công');
    }
    function edit($id): View
    {
        $faq = Faq::findOrFail($id);
        $faq_categories=FaqCategory::latest()->get();
        return view('admin.faq.update', compact('faq','faq_categories'));
    }
    function update(Request $request, $id): RedirectResponse
    {
        $validate = $request->validate([
            'title' => 'required',
            'cat_id' => 'required',
            'details' => 'required',
        ]);
        Faq::where('id', $id)->update($validate);
        return redirect()->route('admin.faq.index')->with('success', 'Cập nhật câu hỏi thường gặp thành công');
    }
    function delete($id): RedirectResponse
    {
        Faq::findOrFail($id)->delete();
        return redirect()->route('admin.faq.index')->with('success', 'Xóa câu hỏi thường gặp thành công');
    }

}
