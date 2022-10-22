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
                    <div class="btn-group">

                        <select wire:change="maropsi($event.target.value)" style="height: 2rem; outline: 2px solid transparent;" class="px-1 rounded border-0">
                            <option value="TODAY">Hari ini</option>
                            <option value="MTD">Bulan Ini</option>
                            <!-- <option value="YTD">Year to Date</option> -->
                        </select>
                        <!-- <button wire:click.prevent="markAllAsCheckout" type="button" class="btn btn-success btn-sm">
                            CheckOut
                        </button> -->
                    </div>
                    @if ($selectedRows)

                    <div class="btn-group">

                        <button wire:click.prevent="markAllAsCheckout" type="button" class="btn btn-success btn-sm">
                            CheckOut
                        </button>
                        <button wire:click.prevent="markAllAsCheckin" type="button" class="btn btn-danger btn-sm">
                            Batal CheckOut
                        </button>
                    </div>
                    @endif

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
                                    <th>
                                        <div class="icheck-primary d-inline">
                                            <input wire:model="selectPageRows" type="checkbox" value="" name="todo2" id="todoCheck2">
                                            <label for="todoCheck2"></label>
                                        </div>
                                    </th>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Asal Sekolah/Institusi</th>
                                    <th>Lokasi Magang</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Pembimbing</th>
                                    <th>Status</th>
                                </tr>
                                @forelse ($magang as $index => $ts)
                                <tr>
                                    <td style="width: 10px;">
                                        <div class="icheck-primary d-inline">
                                            <input wire:model="selectedRows" type="checkbox" value="{{ $ts->id }}" name="todo2" id="{{ $ts->id }}">
                                            <label for="{{ $ts->id }}"></label>
                                        </div>
                                    </td>
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


                                </tr>
                                @empty
                                <tr class="text-center">
                                    <td colspan="9">
                                        <img src="https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/v2/assets/empty.svg" alt="No results found">
                                        <p class="mt-2">Belum ada Tamu Hari Ini</p>
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
                            <span>Edit Bagian</span>
                            @else
                            <span>Tambah Bagian</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" wire:model.defer="state.nama" class="form-control @error('nama') is-invalid @enderror" id="nama" aria-describedby="nameHelp" placeholder="Enter Nama Tenant">
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="sekolah">sekolah Lengkap</label>
                            <input type="text" wire:model.defer="state.sekolah" class="form-control @error('sekolah') is-invalid @enderror" id="sekolah" aria-describedby="nameHelp" placeholder="Enter sekolah Tenant">
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


                        <div class="form-group">
                            <label for="pembimbing">Pembimbing</label>
                            <input type="text" wire:model.defer="state.pembimbing" class="form-control @error('pembimbing') is-invalid @enderror" id="pembimbing" aria-describedby="nameHelp" placeholder="Enter pembimbing Tenant">
                            @error('pembimbing')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
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
</div>

@push('js')
<script type="text/javascript" src="https://unpkg.com/moment"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
@endpush