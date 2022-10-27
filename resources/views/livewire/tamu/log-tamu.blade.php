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
                                    <th>Instansi</th>
                                    <th>Tujuan</th>
                                    <th>Keperluan</th>
                                    <th>Tglcheckin</th>
                                    <th>Tgl checkout</th>
                                    <th>Status</th>
                                </tr>
                                @forelse ($logtamu as $index => $ts)
                                <tr>
                                    <td style="width: 10px;">
                                        <div class="icheck-primary d-inline">
                                            <input wire:model="selectedRows" type="checkbox" value="{{ $ts->id }}" name="todo2" id="{{ $ts->id }}">
                                            <label for="{{ $ts->id }}"></label>
                                        </div>
                                    </td>
                                    <td>{{ $logtamu->firstItem() + $index }}</td>
                                    <td>{{ $ts->tamu->nama }}</td>
                                    <td>{{ $ts->tamu->instansi }}</td>
                                    <td>{{ $ts->bagian->namaTenant }}</td>
                                    <td>{{ $ts->keperluan }}</td>
                                    <td>{{ $ts->checkin }}</td>
                                    <td>{{ $ts->checkout}}</td>
                                    @if ($ts->checkout)
                                    <td><span class="badge badge-success px-1">CHECKOUT</span> </td>
                                    @else
                                    <td> <span class="badge badge-primary  px-1">CHECKIN</span></td>
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
                <div class="card-footer">
                    {!! $logtamu->links() !!}
                </div>
            </div>
        </div>

        <!-- /.col -->.
    </section>
</div>
<!-- /.row -->

<!-- /.conte
</div>
 