<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                    <h3>Working Permit</h3>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form autocomplete="off" wire:submit.prevent="create">
                                <div class="form-group">
                                    <label for="inputAddress">Mitra</label>
                                    <input type="text" wire:model.defer="mitra" class="form-control @error('mitra') is-invalid @enderror" id="mitra" placeholder="Mitra ">
                                    @error('mitra')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group ">
                                    <label for="inputCity">Judul Pekerjaan</label>
                                    <input type="text" wire:model.defer="judulpekerjaan" class="form-control @error('judulpekerjaan') is-invalid @enderror" id="judulpekerjaan" placeholder="Judul Pekerjaan ">
                                    @error('judulpekerjaan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Nama Kordinator Mitra</label>
                                    <input type="text" wire:model.defer="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="nama ">
                                    @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">No Wp</label>
                                        <input type="text" wire:model.defer="nowp" class="form-control @error('nowp') is-invalid @enderror" id="nowp" placeholder="nowp ">
                                        @error('nowp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">No Handphone</label>
                                        <input type="text" wire:model.defer="tlpn" class="form-control @error('tlpn') is-invalid @enderror" id="tlpn" placeholder="tlpn ">
                                        @error('tlpn')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-row">


                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="inputCity">Titik Kordinat</label>
                                            <input type="text" name="titikkor" id="titikkor" wire:model.defer="titikkor" class="form-control @error('titikkor') is-invalid @enderror" placeholder="Lokasi">
                                            @error('titikkor')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="inputCity">Lokasi</label>
                                            <input type="text" wire:model.defer="lokasi" class="form-control @error('lokasi') is-invalid @enderror" id="lokasi" placeholder="Lokasi">
                                            @error('lokasi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="tglawal">Tanggal Mulai</label>
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                </div>
                                                <x-datepicker wire:model.defer="tglawal" id="tglawal" :error="'tglawal'" />

                                            </div>
                                            @error('tglawal')
                                            <div class="text-danger mt-1 mb-3 " style="font-size: 12px;">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="tglakhir">Tanggal Berakhir</label>
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                </div>
                                                <x-datepicker wire:model.defer="tglakhir" id="tglakhir" :error="'tglakhir'" />

                                            </div>
                                            @error('tglakhir')
                                            <div class="text-danger mt-1 mb-3 " style="font-size: 12px;">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <h3>Upload Anggota</h3>
                                            <hr>
                                            <div class="form-group">
                                                <label for="customFile">File Import</label>
                                                <div class="custom-file">
                                                    <div x-data="{ isUploading: false, progress: 5 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false; progress = 5" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                        <input wire:model="fileimport" type="file" class="custom-file-input" id="customFile">
                                                        <div x-show.transition="isUploading" class="progress progress-sm mt-2 rounded">
                                                            <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`">
                                                                <span class="sr-only">40% Complete (success)</span>
                                                            </div>
                                                        </div>
                                                        @error('fileimport')
                                                        <div class="text-danger mt-1 mb-3 " style="font-size: 12px;">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <label class="custom-file-label" for="customFile">
                                                        @if ($fileimport)
                                                        {{ $fileimport->getClientOriginalName() }}
                                                        @else
                                                        Choose File
                                                        @endif
                                                    </label>
                                                </div>
                                                <a href="" wire:click.prevent="downloadfileimport" class="text-primary"> Download Format File Import</a>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-7">
                                        <label for="inputAddress">Peta</label>
                                        @include('livewire/workingpermit/js')
                                        @error('log')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>