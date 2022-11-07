<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                    <h3>Detail Working Permit</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Working Permit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content mb-5">
        <div class="container-fluid">
            <div class="btn-group mb-3 shadow-sm">
                <a href="{{ route('listworking') }}" type="button" class="btn bg-white">
                    <i class="fas fa-reply mr-2"></i>List Working Permit
                </a>
                @role('admin')
                <a href="{{ route('createworking') }}" type="button" class="btn bg-white">
                    <i class="fa fa-plus-circle mr-2"></i>Working Permit
                </a>
                @endrole
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-text-width"></i>
                                Mitra {{$state['mitra']}}
                            </h3>
                            @role('admin')
                            <div class="float-right">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" wire:click.prevent="editmitra()" class="btn btn-info shadow-sm btn-sm"><i class="fa fa-edit mr-2"></i>Edit</button>
                                    <button type="button" wire:click.prevent="hapusmitra()" class="btn btn-danger shadow-sm btn-sm"><i class="fas fa-trash mr-2"></i>Hapus</button>
                                </div>
                            </div>
                            @endrole
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <dl>
                                <dt>Judul Pekerjaan</dt>
                                <dd>{{$state['judulpekerjaan']}}</dd>
                                <dt>Lokasi</dt>
                                <dd>{{$state['lokasi']}}</dd>
                                <dt>Durasi</dt>
                                <dd>Tanggal Mulai <span class="text-bold">{{$state['tglawal']}}</span> Tanggal Berakhir <span class=" text-bold">{{$state['tglakhir']}}</span> </dd>

                            </dl>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-7">
                    @role('admin')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-text-width"></i>
                                {{ $showEditModal ? 'Edit Anggota' : 'Tambah Anggota'}}
                            </h3>
                        </div>
                        <div class="card-body">
                            @if ($showEditModal)
                            <form wire:submit.prevent="">
                                <div class="add-input">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nama">Nama Lengkap</label>
                                                <input type="text" wire:model.defer="nama.0" class="form-control @error('nama.0') is-invalid @enderror" id="nama" aria-describedby="nameHelp" placeholder="Enter Nama Lengkap">
                                                @error('nama.0')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" wire:click.prevent="editproses()" class="btn btn-primary"><i class="fa fa-edit mr-2"></i>Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @else
                            <form autocomplete="off" wire:submit.prevent="store">
                                <div class="add-input">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label for="nama">Nama Lengkap</label>
                                                <input type="text" wire:model.defer="nama.0" class="form-control @error('nama.0') is-invalid @enderror" id="nama" aria-describedby="nameHelp" placeholder="Enter Nama Lengkap">
                                                @error('nama.0')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <label for="nama" class="text-white">tambah</label>
                                            <button class="btn btn-info" wire:click.prevent="add({{$i}})"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                @foreach($inputs as $key => $value)
                                <div class="add-input">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Enter nama Lengkap" wire:model.defer="nama.{{ $value }}">
                                                @error('nama.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button class="btn btn-danger btn-sm" wire:click.prevent="remove({{$key}})"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success  shadow px-2 btn-sm"><i class="fa fa-save mr-2"></i>Simpan</button>
                                    </div>
                                </div>
                            </form>
                            @endif

                        </div>
                    </div>
                    @endrole
                    <div class="card">
                        <div class="card-header">
                            <div class="float-left">
                                <h4>Daftar Anggota</h4>
                            </div>
                            <div class="float-right">
                                {!! $personil->links() !!}
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group">
                                @forelse ($personil as $index => $ts)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div> <span class="mr-1">{{ $personil->firstItem() + $index }}
                                        </span>
                                        {{ $ts->nama }}
                                    </div>
                                    @role('admin')
                                    <div class="btn-group btn-group-sm">
                                        <a href="#" wire:click.prevent="edit({{ $ts }})" class="text-info"><i class="fa fa-edit mr-2"></i></a>
                                        <a wire:click.prevent="confirmRemoval({{ $ts }})" class="text-danger"><i class="fas fa-trash"></i></a>
                                    </div>
                                    @endrole
                                </li>
                                @empty
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Tidak Anggota
                                </li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="card-footer">
                            <div class="float-right">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                </div>
            </div>

        </div>
    </section>

    @role('admin')
    <!-- Modal -->
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog  modal-lg" role="document">
            <form autocomplete="off" wire:submit.prevent="updatemitra">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <span>Edit Mitra</span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="mitra">mitra</label>
                            <input type="text" wire:model.defer="state.mitra" class="form-control @error('mitra') is-invalid @enderror" id="mitra" aria-describedby="nameHelp" placeholder="Enter mitra Tenant">
                            @error('mitra')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="row">


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="judulpekerjaan">Judul Pekerjaan</label>
                                    <input type="text" wire:model.defer="state.judulpekerjaan" class="form-control @error('judulpekerjaan') is-invalid @enderror" id="judulpekerjaan" aria-describedby="nameHelp" placeholder="Enter judulpekerjaan Tenant">
                                    @error('judulpekerjaan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lokasi">lokasi</label>
                                    <input type="text" wire:model.defer="state.lokasi" class="form-control @error('lokasi') is-invalid @enderror" id="lokasi" aria-describedby="nameHelp" placeholder="Enter lokasi Tenant">
                                    @error('lokasi')
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
                                    <label for="tglawal">Tanggal Awal</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <x-datepicker wire:model.defer="state.tglawal" id="tglawal" :error="'date'" />
                                        @error('date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tglakhir">Tanggal Berakhir</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <x-datepicker wire:model.defer="state.tglakhir" id="tglakhir" :error="'date'" />
                                        @error('date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
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

    <!-- Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Delete</h5>
                </div>

                <div class="modal-body">
                    <h4>Are you sure you want to delete?</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancel</button>
                    <button type="button" wire:click.prevent="{{ $showHapusModal ? 'deletemitra' : 'delete' }}"" class=" btn btn-danger"><i class="fa fa-trash mr-1"></i>Delete</button>
                </div>
            </div>
        </div>
    </div>
    @endrole

</div>
@push('js')
<script type="text/javascript" src="https://unpkg.com/moment"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
@endpush