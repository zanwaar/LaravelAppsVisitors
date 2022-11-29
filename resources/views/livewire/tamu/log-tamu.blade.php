<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Buku Tamu</h1>
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
            <div class="row">

            </div>
            <div class="btn-group mb-3 shadow-sm">
                <a href="{{ route('daftartamu') }}" class="btn btn-outline-secondary shadow-sm">
                    <i class="fa fa-solid fa-address-book mr-2"></i>Daftar Tamu
                </a>
                <a href="{{ route('tambahtamu') }}" class="btn btn-outline-secondary shadow-sm">
                    <i class="fa fa-plus-circle mr-2"></i>Tambah Tamu
                </a>

                <!-- <a wire:click.prevent="markAllAsCheckout" class="dropdown-item" href="#">Mark as cHECKOUTd</a> -->

            </div>
            <div class="div mb-3 row">
                <form class="col-5" autocomplete="off" wire:submit.prevent="fexcel">
                    <div class="input-group shadow-sm">
                        <input type="date" wire:model="dateawal" class="form-control" required>
                        <input type="date" wire:model="dateakhir" class="form-control" required>
                        <div class="input-group-append" id="button-addon4">
                            <button class="btn btn-primary" type="submit">Export Excel Per Tanggal</button>
                        </div>
                    </div>
                </form>
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
                            <div class="col-6">
                                <select wire:change="maropsi($event.target.value)" class="form-control px-1 rounded mr-3 shadow-sm">
                                    <option value="ALL">All</option>
                                    <option value="TODAY">Hari ini</option>
                                    <option value="MTD">Bulan ini</option>
                                    <option value="YTD">Tahun ini</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="float-right">
                        @if ($selectedRows)

                        <div class="btn-group shadow-sm mr-3">
                            <button wire:click.prevent="markAllAsCheckout" type="button" class="btn btn-outline-secondary">
                                CheckOut
                            </button>
                            <button wire:click.prevent="markAllAsCheckin" type="button" class="btn btn-outline-secondary">
                                Batal CheckOut
                            </button>
                            <button wire:click.prevent="export" type="button" class="btn btn-outline-secondary">
                                Export Excel
                            </button>
                        </div>
                        @endif
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
                                        <img src="{{$ts->foto_url}}" wire:click.prevent="btndetail({{ $ts }})" class="img d-block mt-2 rounded" width="100" height="">
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
    <div class="modal fade" id="ExportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
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
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>Import</button>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /.row -->

<!-- /.conte
</div>
 