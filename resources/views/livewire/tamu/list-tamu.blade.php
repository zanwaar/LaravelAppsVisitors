<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Tamu</h1>
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
    <section class="content">
        <div class="container-fluid">
            <div class="btn-group mb-3 shadow-sm">
                <a href="{{ route('tamu') }}" type="button" class="btn bg-white text-muted">
                    <i class="fas fa-reply mr-2"></i>log Tamu
                </a>
                <a href="{{ route('tambahtamu') }}" type="button" class="btn bg-white text-muted">
                    <i class="fa fa-plus-circle mr-2"></i>Tambah Tamu
                </a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Tamu</h3>
                    <div class="card-tools">
                        <div class=" input-group input-group-sm">
                            <x-search-input wire:model="searchTerm" />
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <tbody wire:loading.class="text-muted">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Instansi</th>
                                    <th>Jenis ID</th>
                                    <th>No Identitas</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                </tr>
                                @forelse ($tamu as $index => $ts)
                                <tr>
                                    <td>{{ $tamu->firstItem() + $index }}</td>
                                    <td>{{ $ts->nama }}</td>
                                    <td>{{ $ts->instansi }}</td>
                                    <td>{{ $ts->jenisid }}</td>
                                    <td>{{ $ts->ni }}</td>
                                    <td>{{ $ts->jk }}</td>
                                    <td>{{ $ts->alamat}}</td>
                                </tr>
                                @empty
                                <tr class="text-center">
                                    <td colspan="7">
                                        <img src="https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/v2/assets/empty.svg" alt="No results found">
                                        <p class="mt-2">No results found</p>
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
                <div class="card-footer p-0">
                    <div class="float-right">
                        {!! $tamu->links() !!}
                        <!-- /.btn-group -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->.
    </section>
</div>
<!-- /.row -->
<!-- /.conte
</div>
 