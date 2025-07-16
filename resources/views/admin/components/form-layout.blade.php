{{-- 
    Admin Form Layout Component
    Usage: @include('admin.components.form-layout', [
        'title' => 'Form Title',
        'icon' => 'fas fa-icon',
        'action' => '/dashboard/route',
        'method' => 'POST', // POST, PUT, PATCH
        'enctype' => 'multipart/form-data', // optional
        'size' => 'lg' // sm, md, lg, xl
    ])
    
    @slot('form_content')
        // Your form fields here
    @endslot
    
    @slot('submit_button')
        // Optional custom submit button
    @endslot
--}}

@extends('admin.layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/admin-forms.css') }}">
@endpush

@section('content')
<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-xl-{{ $size == 'sm' ? '6' : ($size == 'md' ? '8' : ($size == 'lg' ? '8' : '10')) }} col-lg-{{ $size == 'sm' ? '8' : '10' }}">
            <div class="card admin-form-container">
                <div class="admin-form-header">
                    <h4>
                        @if(isset($icon))
                            <i class="{{ $icon }}"></i>
                        @endif
                        {{ $title }}
                    </h4>
                </div>
                <div class="admin-form-body">
                    <form method="{{ $method ?? 'POST' }}" 
                          action="{{ $action }}" 
                          @if(isset($enctype)) enctype="{{ $enctype }}" @endif>
                        @csrf
                        
                        @if(isset($method) && in_array(strtoupper($method), ['PUT', 'PATCH', 'DELETE']))
                            @method($method)
                        @endif
                        
                        {{ $form_content }}
                        
                        @if(isset($submit_button))
                            {{ $submit_button }}
                        @else
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="admin-btn-primary">
                                    <i class="fas fa-save"></i>
                                    Simpan Data
                                </button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/admin/admin-forms.js') }}"></script>
@endpush
@endsection
