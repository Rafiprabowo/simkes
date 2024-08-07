@extends('template')
@section('aside')
    @include('partials.aside.apoteker')
@endsection
@section('content')
    <div class="col-12">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M5 12l5 5l10 -10" />
                </svg>
            </div>
            <div>
                {{ session('success') }}
            </div>
            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
        @endif
         @if($errors->any())
                <div class="alert alert-danger m-3">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li class="alert-title">{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
          @endif
            <div class="d-flex">
                <div class="mb-3">
                <a href="{{route('kategori-obat.create')}}" class="btn btn-primary">Tambah Kategori Obat</a>
            </div>
            <div class="mx-3">
            <a href="{{route('apoteker.dashboard')}}" class="btn btn-secondary">Kembali</a>
        </div>
            </div>
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Data Kategori obat</h3>
                  </div>
                  <div class="card-body border-bottom py-3">
                    <div class="d-flex">
                      <div class="text-muted">
                        Menampilkan
                        <div class="mx-2 d-inline-block">
                          <input type="text" class="form-control form-control-sm" value="{{$categories->total()}}" size="3" aria-label="Invoices count">
                        </div>
                        data
                      </div>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Kategori</th>
                          <th>Deskripsi Kategori</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>

                      <tbody>
                      @forelse($categories as $index => $medicineCategory)
                          <tr>
                              <td>{{$index + 1}}</td>
                              <td>{{$medicineCategory->name}}</td>
                              <td>{{$medicineCategory->description}}</td>
                              <td>
                                  <div class="d-flex justify-content-start">
                                      <a href="" class="btn btn-primary mx-2">Lihat</a>
                                      <a href="{{route('kategori-obat.edit', $medicineCategory->id)}}" class="btn btn-secondary mx-2">Ubah</a>
                                      <form action="{{ route('kategori-obat.destroy', $medicineCategory->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger mx-2">Hapus</button>
                                        </form>
                                  </div>
                              </td>
                          </tr>
                      @empty
                          <tr>
                              <td>Tidak ada data yang tersedia</td>
                          </tr>
                      @endforelse
                      </tbody>
                    </table>
                  </div>
                <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-muted">
                        Menampilkan {{ $categories->firstItem() }} hingga {{ $categories->lastItem() }} dari {{ $categories->total() }} data
                    </p>
                    {{ $categories->links() }}
                </div>

                </div>
              </div>
@endsection
