@extends('layouts.app')

@section('title')
    Faq
@endsection

@section('content')
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumbs">
                        <li><a href="/">Trang chủ</a></li>
                    
                        <li class="separator"></li>
                        <li>{{ $faqcategory?->name ?? 'Không có danh mục' }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container padding-bottom-1x mb-3">
        @if ($faqcategory && $faqcategory->faqs->count())
            @foreach ($faqcategory->faqs as $faq)
                <div class="accordion" id="accordion{{ $loop->index }}">
                    <div class="card accordion-item mb-4">
                        <div id="collapse{{ $loop->index }}" class="accordion-collapse show" <!-- Thêm class "show" để mở sẵn -->
                            <div class="card-body">{!! $faq->details !!}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center">Không tìm thấy câu hỏi nào trong danh mục này.</p>
        @endif
    </div>

@endsection
