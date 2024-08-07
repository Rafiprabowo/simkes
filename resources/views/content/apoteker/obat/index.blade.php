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
                <a href="{{route('obat.create')}}" class="btn btn-primary">Tambah Obat</a>
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
                          <input type="text" class="form-control form-control-sm" value="{{$medicines->total()}}" size="3" aria-label="Invoices count">
                        </div>
                        data
                      </div>
                     <x-search-bar
                        action="{{route('medicine.search')}}"
                        placeholder="berdasarkan nama"
                        buttonText="Cari"
                        value="{{ request('search') }}"
                    />
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Obat</th>
                          <th>Kategori Obat</th>
                            <th>Deskripsi Obat</th>
                          <th>Stok</th>
                            <th>Satuan</th>
                            <th>Aksi</th>
                        </tr>
                      </thead>

                      <tbody>
                      @forelse($medicines as $index => $medicine)
                          <tr>
                              <td>{{$index + 1}}</td>
                              <td>{{$medicine->name}}</td>
                              <td>{{$medicine->categories->name}}</td>
                              <td>{{$medicine->description}}</td>
                              <td>{{$medicine->stock}}</td>
                              <td>{{$medicine->satuan}}</td>
                              <td>
                                  <div class="d-flex justify-content-start">
                                      <a href="" class="btn btn-primary mx-2">Lihat</a>
                                  <a href="{{ route('obat.edit', $medicine->id) }}" class="btn btn-secondary mx-2">Ubah</a>

                                         <form action="{{ route('obat.destroy', $medicine->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus obat ini?');">
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
                <p class="m-0 text-muted">Menampilkan {{ $medicines->firstItem() }} hingga {{ $medicines->lastItem() }} dari {{ $medicines->total() }} data</p>
                {{ $medicines->links() }}
            </div>
                </div>
              </div>
@endsection
