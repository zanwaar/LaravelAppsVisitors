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
        </div><!-- /.container-fluid -->
    </div>

    <section class="content mb-5">
        <div class="container-fluid">
            <div class="btn-group mb-3 shadow-sm">
                <button wire:click.prevent="addNew" class="btn btn-info shadow-sm"><i class="fa fa-plus-circle mr-1"></i>Tambah Pkl/Magang</button>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h3 class="card-title">Log Daftar Pkl / Mangang</h3>
                    </div>

                    <div class="float-right">

                        <div class="btn-group">

                            <div class=" input-group input-group-sm">
                                <x-search-input wire:model="searchTerm" />
                            </div>
                        </div>

                    </div>
                    <!-- /.card-tools -->
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
                                        <a href="" wire:click.prevent="edit({{ $ts }})">
                                            <i class="fa fa-edit mr-2"></i>
                                        </a>

                                        <a href="" wire:click.prevent="confirmRemoval({{ $ts }})">
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>
                                    </td>

                                </tr>
                                @empty
                                <tr class="text-center">
                                    <td colspan="10">
                                        <img src="https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/v2/assets/empty.svg" alt="No results found">
                                        <p class="mt-2">NOT FOUND</p>
                                    </td>
                                </tr>

                                @endforelse

                            </tbody>
                        </table>
                        <!-- /.table -->
                    </div>
                    <!-- /.mail-box-messages -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer d-flex justify-content-end">
                    {!! $magang->links() !!}
                </div>
            </div>
        </div>

        <!-- /.col -->.
    </section>

    <!-- Modal -->
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog  modal-lg" role="document">
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
                            <label for="bagian_id">Lokasi Mangang</label>
                            <select wire:model.defer="state.bagian_id" class="form-control @error('bagian_id') is-invalid @enderror">
                                <option value="">Select Lokasi Mangang</option>
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
                                    <input type="text" wire:model.defer="state.pembimbing" class="form-control @error('pembimbing') is-invalid @enderror" id="pembimbing" placeholder="Enter pembimbing">
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
                    <button type="button" wire:click.prevent="delete" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script type="text/javascript" src="https://unpkg.com/moment"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
@endpush