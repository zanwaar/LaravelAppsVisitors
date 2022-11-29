<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Log Barang / Surat</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Barang / Surat</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content mb-5">
        <div class="container-fluid">
            <div class="btn-group mb-3 shadow-sm">
                <button wire:click.prevent="addNew" class="btn btn-info shadow-sm"><i class="fa fa-plus-circle mr-2"></i>Tambah Data</button>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="float-left mr-3">
                        <select wire:change="row($event.target.value)" class="form-control rounded shadow-sm mr-3">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="btn-group shadow-sm btn-group">
                        <button wire:click="filterBarangsByStatus('')" type="button" class="btn btn-outline-secondary">ALL</button>
                        <button wire:click="filterBarangsByStatus(0)" type="button" class="btn btn-outline-secondary">Belum Diambil</button>
                        <button wire:click="filterBarangsByStatus(1)" type="button" class="btn btn-outline-secondary">Sudah Diambil</button>
                    </div>
                    <div class="float-right">
                        <div class="btn-group">
                            <div class=" input-group input-group-sm">
                                <x-search-input wire:model="searchTerm" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <tbody class="">
                                <tr class="bg-dark ">
                                    <th>#</th>
                                    <th>Jenis</th>
                                    <th>Nama Surat/Barang</th>
                                    <th>Pengirim</th>
                                    <th>Penerima</th>
                                    <th>Ruang Dituju</th>
                                    <th>Diambil OLeh</th>
                                    <th>Status</th>
                                    <th style="width: 8px;">Options</th>
                                </tr>
                                @forelse ($barang as $index => $ts)
                                <tr>
                                    <td>{{ $barang->firstItem() + $index }}</td>
                                    <td>{{ $ts->jenis }}</td>
                                    <td>{{ $ts->nama}}</td>
                                    <td>{{ $ts->pengirim}}</td>
                                    <td>{{ $ts->penerima}}</td>
                                    <td>{{ $ts->bagian->namaTenant }}</td>
                                    <td>{{ $ts->diambil}}</td>
                                    <td><span class="badge badge-{{ $ts->status_badge }}">{{$ts->status}}</span></td>
                                    @if (!$ts->tgldiambil)
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="#" wire:click.prevent="Diambil({{ $ts }})" class="btn btn-warning btn-sm text-white"><i class="fa fa-power-off"></i></a>
                                            <a href="#" wire:click.prevent="edit({{ $ts }})" class="btn btn-info btn-sm text-white"><i class="fa fa-edit"></i></a>
                                            <a href="#" wire:click.prevent=" confirmRemoval({{ $ts }})" class="btn btn-danger text-white"><i class="fas fa-trash"></i></a>

                                        </div>

                                    </td>
                                    @else
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="#" wire:click.prevent=" detail({{ $ts }})" class="btn btn-info text-white"><i class="fas fa-eye"></i></a>
                                            <a href="#" wire:click.prevent=" confirmRemoval({{ $ts }})" class="btn btn-danger text-white"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                                @empty
                                <tr class="text-center">
                                    <td colspan="10">
                                        <img src="https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/v2/assets/empty.svg" alt="No results found">
                                        <p class="mt-2">No Results Found</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    {!! $barang->links() !!}
                </div>
            </div>
        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog  modal-lg" role="document">
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'update' : 'create' }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if($showEditModal)
                            <span>Edit Surat / Barang</span>
                            @else
                            <span>Tambah Surat / Barang</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis">Jenis Barang / Surat</label>
                                    <select wire:model.defer="state.jenis" class="form-control @error('jenis') is-invalid @enderror">
                                        <option value="">Select</option>
                                        <option value="Surat">Surat</option>
                                        <option value="Dokumen">Dokumen</option>
                                        <option value="Barang">Barang</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                    @error('jenis')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama Surat/ Barang</label>
                                    <input type="text" wire:model.defer="state.nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Maukan Nama Surat / Barang">
                                    @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pengirim">Pengirim</label>
                                    <input type="text" wire:model.defer="state.pengirim" class="form-control @error('pengirim') is-invalid @enderror" id="pengirim" placeholder="Masukan Pengirim ">
                                    @error('pengirim')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="penerima">Penerima</label>
                                    <input type="text" wire:model.defer="state.penerima" class="form-control @error('penerima') is-invalid @enderror" id="penerima" placeholder="Masukan penerima ">
                                    @error('penerima')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bagian_id">Ruang dituju</label>
                            <select wire:model.defer="state.bagian_id" class="form-control @error('bagian_id') is-invalid @enderror">
                                <option value="">Select</option>
                                @foreach($bagian as $bg)
                                <option value="{{ $bg->id }}">{{ $bg->namaTenant  }}</option>
                                @endforeach
                            </select>
                            @error('bagian_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" wire:model.defer="state.keterangan" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" placeholder="Masukan keterangan ">
                            @error('keterangan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                            @if($showEditModal)
                            <span>Save Changes</span>
                            @else
                            <span>Save</span>
                            @endif
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if ($show)
    <div class="modal fade" id="Diambil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg" role="document">
            <form autocomplete="off" wire:submit.prevent="confirmDiambil">
                <div class="modal-content ">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if ($showdetail)
                            <span>Detail Barang / Surat </span>
                            @else
                            <span>Konfirmasi Barang / Surat </span>
                            @endif
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if (!$showdetail)
                        <div class="form-group">
                            <label for="diambil">Nama Orang yang Mengambil</label>
                            <input type="text" wire:model.defer="state.diambil" class="form-control @error('diambil') is-invalid @enderror" id="diambil" placeholder="Masukan Nama Orang yang Mengambil">
                            @error('diambil')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        @endif
                        <dl class="row">
                            <dt class="col-sm-4 text-muted">Nama Barang / Surat</dt>
                            <dd class="col-sm-8">{{$state['nama']}}</dd>
                            <dt class="col-sm-4 text-muted">Jenis</dt>
                            <dd class="col-sm-8 ">Jenis {{$state['jenis']}}</dd>
                            <dt class="col-sm-4 text-muted">Pengirim</dt>
                            <dd class="col-sm-8">{{$state['pengirim']}}</dd>
                            <dt class="col-sm-4 text-muted">Penerima</dt>
                            <dd class="col-sm-8">{{$state['penerima']}}</dd>
                            <dt class="col-sm-4 text-muted">Lokasi Tujuan</dt>
                            <dd class="col-sm-8">{{$lokasi}}</dd>
                            <dt class="col-sm-4 text-muted">Tanggal Diterima</dt>
                            <dd class="col-sm-8">{{$state['tglditerima']}}</dd>
                            @if ($showdetail)
                            <dt class="col-sm-4 text-muted">Tanggal Diambil</dt>
                            <dd class="col-sm-8">{{$state['tgldiambil']}}</dd>
                            <dt class="col-sm-4 text-muted">Nama Orang yang Mengambil</dt>
                            <dd class="col-sm-8">{{$state['diambil']}}</dd>
                            @endif
                        </dl>
                    </div>
                    <div class="modal-footer">
                        @if ($showdetail)
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Tutup</button>
                        </button>
                        @else
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                            <span>Telah Ambil</span>
                        </button>
                        @endif

                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif



    <!-- Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Delete</h5>
                </div>

                <div class="modal-body">
                    <h4>Konfirmasi Delete</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancel</button>
                    <button type="button" wire:click.prevent="delete" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>