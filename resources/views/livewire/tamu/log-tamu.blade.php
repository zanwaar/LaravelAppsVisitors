<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Log Tamu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Buku Tamu</li>
                    </ol>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="btn-group mb-3 shadow-sm">
                <a href="{{ route('daftartamu') }}" type="button" class="btn bg-white text-muted">
                    <i class="fa fa-solid fa-address-book mr-2"></i>Daftar Tamu
                </a>
                <a href="{{ route('tambahtamu') }}" type="button" class="btn bg-white text-muted">
                    <i class="fa fa-plus-circle mr-2"></i>Tambah Tamu
                </a>
                <!-- <a wire:click.prevent="markAllAsCheckout" class="dropdown-item" href="#">Mark as cHECKOUTd</a> -->

            </div>
            <div class="card">
                <div class="card-header">
                    <div class="btn-group">
                        <select wire:change="row($event.target.value)" class="form-control rounded shadow-sm mr-3">
                            <option value="1">1</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <select wire:change="maropsi($event.target.value)" style="height: 2rem; outline: 2px solid transparent;" class="px-1 rounded border-0 mr-3">
                            <option value="TODAY">Hari ini</option>
                            <option value="MTD">Bulan ini</option>
                            <option value="YTD">Tahun ini</option>
                            <option value="ALL">Tamplikan Semua</option>
                        </select>
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
                                    <th>Instansi</th>
                                    <th>Tujuan</th>
                                    <th>Keperluan</th>
                                    <th>Tglcheckin</th>
                                    <th>Tgl checkout</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                @forelse ($logtamu as $index => $ts)
                                <tr>

                                    <td style="width: 10px; vertical-align:middle;">
                                        <div class="icheck-primary d-inline">
                                            <input wire:model="selectedRows" type="checkbox" value="{{ $ts->id }}" name="todo2" id="{{ $ts->id }}">
                                            <label for="{{ $ts->id }}"></label>
                                        </div>
                                    </td>

                                    <td style="vertical-align:middle;">{{ $logtamu->firstItem() + $index }}
                                    </td>
                                    <td style="vertical-align:middle;">{{ $ts->tamu->nama }}</td>
                                    <td style="vertical-align:middle;">{{ $ts->tamu->instansi }}</td>
                                    <td style="vertical-align:middle;">{{ $ts->bagian->namaTenant }}</td>
                                    <td style="vertical-align:middle;">{{ $ts->keperluan }}</td>
                                    <td style="vertical-align:middle;">{{ $ts->checkin }}</td>
                                    <td style="vertical-align:middle;">{{ $ts->checkout}}</td>
                                    @if ($ts->checkout)
                                    <td style="vertical-align:middle;"><span class="badge badge-success px-1">CHECKOUT</span> </td>
                                    @else
                                    <td style="vertical-align:middle;"> <span class="badge badge-primary  px-1">CHECKIN</span></td>
                                    @endif
                                    <td style="vertical-align:middle;">
                                        <img src="{{url('storage/upload/'.$ts->foto)}}" wire:click.prevent="btndetail({{ $ts }})" class="img d-block mt-2 rounded" width="100" height="">
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
                        <!-- /.table -->
                    </div>
                    <!-- /.mail-box-messages -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {!! $logtamu->links() !!}
                </div>
            </div>
        </div>

        <!-- /.col -->.
    </section>
    <!-- Modal -->
    <div class="modal fade" id="detailmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
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
<!-- /.row -->

<!-- /.conte
</div>
 