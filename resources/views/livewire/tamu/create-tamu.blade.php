<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Tamu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item "><a href="#">Buku Tamu</a></li>
                        <li class="breadcrumb-item active">Tambah Tamu</li>
                    </ol>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content  mb-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-5">
                    <div class="btn-group mb-3 shadow-sm">
                        <a href="{{ route('tamu') }}" type="button" class="btn btn-outline-secondary shadow-sm">
                            <i class="fas fa-reply mr-2"></i>log Tamu
                        </a>
                        <a href="{{ route('daftartamu') }}" type="button" class="btn btn-outline-secondary shadow-sm">
                            <i class="fa fa-solid fa-address-book mr-2"></i>Daftar Tamu
                        </a>
                        <!-- <a href="" wire:click.prevent="edit('90365a13-7f5a-41e7-abc6-bae8f30e3cb8') type=" button" class="btn bg-white text-muted">
                            <i class="fa fa-plus-circle mr-2"></i>Scan Barcode
                        </a> -->

                    </div>
                </div>
                <div class="col-7">
                    <form autocomplete="off" wire:submit.prevent="fsearch">
                        <div class="input-group">
                            <input type="search" wire:model.defer="nsearch" required class="form-control" placeholder="Masukan Nomor Identitas">
                            <div class="input-group-append">
                                <button type="submit" class="btn  btn-secondary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <form autocomplete=" off" wire:submit.prevent="{{ $show ? 'update' : 'create' }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-info">

                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" {{ $show  ? 'readonly' : '' }} wire:model.defer="state.nama" class="form-control @error('nama') is-invalid @enderror" id="nama" aria-describedby="nameHelp" ">
                                            @error('nama')
                                            <div class=" invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    @if (!$show)
                                    <div class="form-group">
                                        <label for="client">Jenis ID</label>
                                        <select wire:model.defer="state.jenisid" class="form-control @error('jenisid') is-invalid @enderror">
                                            <option value="">Select Jenis ID</option>
                                            <option value="KTP">KTP</option>
                                            <option value="SIM">SIM</option>
                                            <option value="PASSPOR">PASSPOR</option>
                                            <option value="KITAS">KITAS</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                        @error('jenisid')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    @else
                                    <div class="form-group">
                                        <label for="client">Jenis ID</label>
                                        <input type="text" {{ $show  ? 'readonly' : '' }} wire:model.defer="state.jenisid" class="form-control @error('jenisid') is-invalid @enderror" id="jenisid" aria-describedby="nameHelp">
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ni">Nomor Identitas</label>
                                        <input type="text" {{ $show  ? 'readonly' : '' }} wire:model.defer="state.ni" class="form-control @error('ni') is-invalid @enderror" id="ni" aria-describedby="nameHelp">
                                        @error('ni')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="instansi">Instansi</label>
                                        <input type="text" {{ $show  ? 'readonly' : '' }} wire:model.defer="state.instansi" class="form-control @error('instansi') is-invalid @enderror" id="instansi" aria-describedby="nameHelp">
                                        @error('instansi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    @if (!$show)
                                    <div class="form-group">
                                        <label for="jk">Jenis Kelamin</label>
                                        <select wire:model.defer="state.jk" class="form-control @error('jk') is-invalid @enderror">
                                            <option value="">Select Jenis Kelamin</option>
                                            <option value="Laki Laki">Laki Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                        @error('jk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>


                                    @else
                                    <div class="form-group">
                                        <label for="jk">Jenis Kelamin</label>
                                        <input type="text" {{ $show  ? 'readonly' : '' }} wire:model.defer="state.jk" class="form-control @error('jk') is-invalid @enderror" id="jk" aria-describedby="nameHelp">
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" {{ $show  ? 'readonly' : '' }} wire:model.defer="state.alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" aria-describedby="nameHelp">
                                        @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">from input Tamu</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="tenant">Tujuan Tenant</label>
                                <select wire:model.defer="state.tenant" class="form-control @error('tenant') is-invalid @enderror">
                                    <option value="">Select Tenant</option>
                                    @foreach($bagian as $bg)
                                    <option value="{{ $bg->id }}">{{ $bg->namaTenant }}</option>
                                    @endforeach
                                </select>
                                @error('tenant')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="keperluan">Keperluan</label>
                                <input type="text" wire:model.defer="state.keperluan" class="form-control @error('keperluan') is-invalid @enderror" id="keperluan" aria-describedby="nameHelp">
                                @error('keperluan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                                <span>Save</span>
                            </button>
                            <button wire:click.prevent="cancel" type="button" class="btn btn-secondary"><i class="fa fa-times mr-1"></i>
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">from input Tamu</h3>
                        </div>

                        <div class="card-body">
                            <button type="button" class="btn btn-info mb-3 btn-sm" data-toggle="modal" wire:click.prevent="fwebcam">
                                Take Snapshot
                            </button>
                            <input type="hidden" wire:model="state.foto" class="image-tag">
                            <div class="form-group">
                                <img id="image-webcam" src="{{ $twebcam }}" class="img d-block mt-2 w-100 rounded">
                                @error('foto')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="modal-webcam" tabindex="-1" role="dialog" aria-labelledby="modal-webcamLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-body">
                                        <div id="my_camera"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type=button class="btn btn-info" value="Take Snapshot" onClick="take_snapshot()">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                      


                    </div>
                </div>
            </form>
        </div>
    </section>

</div>

@include('livewire/tamu/tamu-js')