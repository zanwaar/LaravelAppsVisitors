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
    <form autocomplete="off" wire:submit.prevent="updatemitra">
        <div class="card card-body shadow-sm">
            <div class="form-group">
                <label for="mitra">mitra</label>
                <input type="text" wire:model.defer="state.mitra" class="form-control @error('mitra') is-invalid @enderror" id="mitra" aria-describedby="nameHelp" placeholder="Enter mitra Tenant">
                @error('mitra')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputAddress">Nama Kordinator Mitra</label>
                <input type="text" wire:model.defer="state.nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="nama ">
                @error('nama')
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
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputAddress">No Wp</label>
                    <input type="text" wire:model.defer="state.nowp" class="form-control @error('nowp') is-invalid @enderror" id="nowp" placeholder="nowp ">
                    @error('nowp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress">No Handphone</label>
                    <input type="text" wire:model.defer="state.tlpn" class="form-control @error('tlpn') is-invalid @enderror" id="tlpn" placeholder="tlpn ">
                    @error('tlpn')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
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
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group ">
                        <label for="inputCity">Titik Kordinat</label>
                        <input type="text" name="titikkor" id="titikkor" wire:model.defer="state.titikkor" class="form-control @error('lokasi') is-invalid @enderror" placeholder="Lokasi">
                        @error('titikkor')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                        <span>Save Changes</span>
                    </button>
                </div>

                <div class="col-md-8">
                    <div id="map2" wire:ignore style="width: 100%; height: 550px;"></div>

                </div>
            </div>

        </div>

    </form>
</div>
@include('livewire/workingpermit/jsedit')