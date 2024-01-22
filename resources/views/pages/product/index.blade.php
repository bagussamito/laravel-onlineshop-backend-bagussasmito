@extends('layouts.app')

@section('title', 'Product')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Produk</h1>
                <div class="section-header-button">
                    <a href="{{ route('product.create') }}" class="btn btn-primary">Tambah Produk</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="home">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Produk</a></div>
                    <div class="breadcrumb-item">All Product</div>
                </div>
            </div>
            <div class="section-body">
                {{-- <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div> --}}

                <p class="section-lead">
                    Semua Pengguna Aplikasi Onlineshop BoronGan
                </p>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="float-left">
                                    <form method="GET" action="{{ route('product.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="search">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="clearfix mb-3"></div>
                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>Name</th>
                                            <th>Desription</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($products as $product)
                                            <tr>

                                                <td>{{ $product->name }}
                                                </td>
                                                <td>{{ $product->description }}
                                                </td>
                                                <td>{{ $product->category_id }}
                                                </td>
                                                <td>{{ $product->price }}
                                                </td>
                                                <td>{{ $product->stock }}
                                                </td>

                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='{{ route('product.edit', $product->id) }}'
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>

                                                        <form action="{{ route('product.destroy', $product->id) }}"
                                                            method="POST" class="ml-2">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                <i class="fas fa-times"></i> Delete
                                                            </button>
                                                        </form>

                                                        <script>
                                                            document.addEventListener('DOMContentLoaded', function() {
                                                                var deleteButtons = document.querySelectorAll('.confirm-delete');

                                                                deleteButtons.forEach(function(button) {
                                                                    button.addEventListener('click', function(event) {
                                                                        event.preventDefault();

                                                                        // Menggunakan SweetAlert2 untuk konfirmasi penghapusan
                                                                        Swal.fire({
                                                                            icon: 'warning',
                                                                            title: 'Konfirmasi Hapus',
                                                                            text: 'Kamu Yakin Ingin Menghapus Data Produk Ini?',
                                                                            showCancelButton: true,
                                                                            confirmButtonColor: '#d33',
                                                                            cancelButtonColor: '#3085d6',
                                                                            confirmButtonText: 'Delete'
                                                                        }).then((result) => {
                                                                            if (result.isConfirmed) {
                                                                                // Lanjutkan dengan mengirimkan formulir jika pengguna mengonfirmasi
                                                                                button.closest('form').submit();
                                                                                Swal.fire({
                                                                                    icon: 'success',
                                                                                    title: 'Success',
                                                                                    text: 'Data Produk Berhasil Dihapus!',
                                                                                    showConfirmButton: false,
                                                                                    timer: 1500 // Durasi alert ditampilkan dalam milidetik
                                                                                });
                                                                            }
                                                                        });
                                                                    });
                                                                });
                                                            });
                                                        </script>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $products->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endpush
