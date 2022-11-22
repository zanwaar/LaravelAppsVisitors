<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Buku Pkl/Magang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Buku Pkl/Magang</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <section class="content mb-5">
        <div class="container-fluid">
            <div class="btn-group mb-3 shadow-sm">
                <button wire:click.prevent="addNew" class="btn btn-info shadow-sm"><i class="fa fa-plus-circle mr-1"></i>Tambah Pkl/Magang</button>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="float-left ">
                        <div class="row">
                            <div class="col-4">
                                <select wire:change="row($event.target.value)" class="form-control rounded shadow-sm mr-3">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <div class="col-8">
                                <h3 class="card-title mt-2">Log Daftar Pkl / Mangang</h3>
                            </div>
                        </div>
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
                            <tbody>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Asal Sekolah/Institusi</th>
                                    <th>Lokasi Magang</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Pembimbing</th>
                                    <th>Status</th>
                                    <th scope="col">Options</th>
                                </tr>
                                @forelse ($magang as $index => $ts)
                                <tr>
                                    <td>{{ $magang->firstItem() + $index }}</td>
                                    <td>{{ $ts->nama }}</td>
                                    <td>{{ $ts->sekolah }}</td>
                                    <td>{{ $ts->bagian->namaTenant }}</td>
                                    <td>{{ $ts->tglmulai }}</td>
                                    <td>{{ $ts->tglselesai }}</td>
                                    <td>{{ $ts->pembimbing}}</td>
                                    @if ($ts->status !== 0)
                                    <td><span class="badge badge-success px-1">aktif</span> </td>
                                    @else
                                    <td> <span class="badge badge-primary  px-1">exparied</span></td>
                                    @endif
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="#" wire:click.prevent="edit({{ $ts }})" class="btn btn-info btn-sm text-white"><i class="fa fa-edit"></i></a>
                                            <a href="#" wire:click.prevent=" confirmRemoval({{ $ts }})" class="btn btn-danger text-white"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
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
                    {!! $magang->links() !!}
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog  modal-xl" role="document">
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'update' : 'create' }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if($showEditModal)
                            <span>Edit Pkl / Mangang</span>
                            @else
                            <span>Tambah Pkl / Mangang</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" wire:model.defer="state.nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukan Nama Lengkap">
                                    @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="sekolah">Sekolah/Institusi</label>
                                    <input type="text" wire:model.defer="state.sekolah" class="form-control @error('sekolah') is-invalid @enderror" id="sekolah" placeholder="Masukan Sekolah/Institusi">
                                    @error('sekolah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Select Team Members</label>
                                    <select wire:model.defer="state.bagian_id" class="form-control @error('bagian_id') is-invalid @enderror">
                                        <option value="">Select Tenant</option>
                                        @foreach($bagian as $bg)
                                        <option value="{{ $bg->id }}">{{ $bg->namaTenant }}</option>
                                        @endforeach
                                    </select>
                                    @error('bagian_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="tglmulai">Tanggal Mulai</label>
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                </div>
                                                <x-datepicker wire:model.defer="state.tglmulai" id="tglmulai" :error="'tglmulai'" />
                                            </div>
                                            @error('tglmulai')
                                            <div class="text-danger mt-1 mb-3" style="font-size: 12px;">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="tglselesai">Tanggal Selesai</label>
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                </div>
                                                <x-datepicker wire:model.defer="state.tglselesai" id="tglselesai" :error="'tglselesai'" />

                                            </div>
                                            @error('tglselesai')
                                            <div class="text-danger mt-1 mb-3 " style="font-size: 12px;">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label for="pembimbing">Pembimbing</label>
                                            <input type="text" wire:model.defer="state.pembimbing" class="form-control @error('pembimbing') is-invalid @enderror" id="pembimbing" placeholder="Masukan pembimbing">
                                            @error('pembimbing')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group ">
                                            <label for="pembimbing">Status</label>
                                            <br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" wire:model.defer="state.status" name="inlineRadioOptions" id="inlineRadio1" value="1">
                                                <label class="form-check-label" for="inlineRadio1">Aktif</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" wire:model.defer="state.status" name="inlineRadioOptions" id="inlineRadio2" value="0">
                                                <label class="form-check-label" for="inlineRadio2">Expired</label>
                                            </div>
                                            @error('status')
                                            <div class="text-danger  " style="font-size: 12px;">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="customFile">Profile Photo</label>
                                    <div class="custom-file">
                                        <div x-data="{ isUploading: false, progress: 5 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false; progress = 5" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                            <input wire:model="photo" type="file" class="custom-file-input" id="customFile">
                                            <div x-show.transition="isUploading" class="progress progress-sm mt-2 rounded">
                                                <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <label class="custom-file-label" for="customFile">
                                            @if ($photo)
                                            {{ $photo->getClientOriginalName() }}
                                            @else
                                            Choose Image
                                            @endif
                                        </label>
                                    </div>

                                    @if ($photo)
                                    <img src="{{ $photo->temporaryUrl() }}" class="img d-block mt-2 w-100 rounded" height="500">
                                    @else
                                    <img src="{{ $state['foto_url'] ?? url('noimage.png') }}" class="img d-block mb-2 w-100 rounded" height="500">
                                    @endif
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
@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endpush
@push('js')
<script type="text/javascript" src="https://unpkg.com/moment"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
@endpush