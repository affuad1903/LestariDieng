@extends('admin.layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/admin-forms.css') }}">
@endpush

@section('content')
<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <div class="card admin-form-container">
                <div class="admin-form-header">
                    <h4>
                        <i class="fas fa-plus-circle"></i>
                        Tambah Sosial Media
                    </h4>
                </div>
                <div class="admin-form-body">
                    <form method="POST" action="/dashboard/home/socmed" enctype="multipart/form-data">
                        @csrf
                        
                        @include('admin.components.form-select', [
                            'name' => 'platform',
                            'label' => 'Platform Sosial Media',
                            'icon' => 'fas fa-share-alt',
                            'required' => true,
                            'placeholder' => '----- Pilih Platform -----',
                            'options' => [
                                'facebook' => 'Facebook',
                                'instagram' => 'Instagram',
                                'twitter' => 'Twitter',
                                'youtube' => 'YouTube',
                                'linkedin' => 'LinkedIn',
                                'tiktok' => 'TikTok',
                                'whatsapp' => 'WhatsApp'
                            ]
                        ])

                        @include('admin.components.form-input', [
                            'name' => 'url',
                            'label' => 'Link Sosial Media',
                            'type' => 'url',
                            'icon' => 'fas fa-link',
                            'required' => true,
                            'placeholder' => 'Masukkan URL lengkap sosial media (contoh: https://instagram.com/username)',
                            'help_text' => 'Pastikan URL dimulai dengan http:// atau https://'
                        ])
                        
                        @include('admin.components.form-select', [
                            'name' => 'icon',
                            'label' => 'Ikon Sosial Media',
                            'icon' => 'fas fa-icons',
                            'required' => true,
                            'placeholder' => '----- Pilih Ikon Platform -----',
                            'options' => [
                                'fab fa-facebook-f' => 'Facebook',
                                'fab fa-instagram' => 'Instagram',
                                'fab fa-twitter' => 'Twitter',
                                'fab fa-youtube' => 'YouTube',
                                'fab fa-linkedin-in' => 'LinkedIn',
                                'fab fa-tiktok' => 'TikTok',
                                'fab fa-whatsapp' => 'WhatsApp'
                            ],
                            'help_text' => 'Ikon akan otomatis dipilih sesuai platform yang dipilih'
                        ])

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-register text-white">
                                <i class="fas fa-save me-2"></i>Simpan Data
                            </button>
                        </div>
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
