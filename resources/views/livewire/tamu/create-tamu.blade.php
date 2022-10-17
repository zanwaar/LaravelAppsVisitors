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
            <div class="btn-group mb-3 shadow-sm">
                <a href="{{ route('tamu') }}" type="button" class="btn bg-white text-muted">
                    <i class="fas fa-reply mr-2"></i>log Tamu
                </a>
                <a href="" wire:click.prevent="edit('90365a13-7f5a-41e7-abc6-bae8f30e3cb8') type=" button" class="btn bg-white text-muted">
                    <i class="fa fa-plus-circle mr-2"></i>Scan Barcode
                </a>
            </div>
            <form autocomplete="off" wire:submit.prevent="{{ $show ? 'update' : 'create' }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">from input Tamu</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" wire:model.defer="state.nama" class="form-control @error('nama') is-invalid @enderror" id="nama" aria-describedby="nameHelp" ">
                                            @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="client">Jenis ID</label>
                                            <select wire:model.defer="state.jenisid" class="form-control @error('jenisid') is-invalid @enderror">
                                                <option value="">Select Jenis ID</option>
                                                <option value="ktp">KTP</option>
                                                <option value="sim">SIM</option>
                                                <option value="passpor">PASSPOR</option>
                                                <option value="kitas">KITAS</option>
                                                <option value="lainnya">Lainnya</option>
                                            </select>
                                            @error('jenisid')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ni">Nomor Identitas</label>
                                            <input type="text" wire:model.defer="state.ni" class="form-control @error('ni') is-invalid @enderror" id="ni" aria-describedby="nameHelp" >
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
                                            <input type="text" wire:model.defer="state.instansi" class="form-control @error('instansi') is-invalid @enderror" id="instansi" aria-describedby="nameHelp" >
                                            @error('instansi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jk">Jenis Kelamin</label>
                                            <select wire:model.defer="state.jk" class="form-control @error('jk') is-invalid @enderror">
                                                <option value="">Select Jenis Kelamin</option>
                                                <option value="ktp">Laki Laki</option>
                                                <option value="sim">Perempuan</option>
                                            </select>
                                            @error('jk')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <input type="text" wire:model.defer="state.alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" aria-describedby="nameHelp" >
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
                                    <input type="text" wire:model.defer="state.keperluan" class="form-control @error('keperluan') is-invalid @enderror" id="keperluan" aria-describedby="nameHelp" >
                                    @error('keperluan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                                    <span>Save</span>
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
                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <input type="text" wire:model.defer="state.foto" class="form-control @error('foto') is-invalid @enderror" id="foto" aria-describedby="nameHelp" placeholder="Enter Full Name">
                                    @error('foto')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- /.col -->.
</div>
<!-- /.row -->

<!-- /.conte
</div>
 