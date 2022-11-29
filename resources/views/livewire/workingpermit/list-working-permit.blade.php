<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Working Permit</h1>
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

    <section class="content">
        <div class="container-fluid">
            <div class="btn-group mb-3 shadow-sm">
                @role('admin')
                <a href="{{ route('createworking') }}" type="button" class="btn bg-white text-muted">
                    <i class="fa fa-plus-circle mr-2"></i>Working Permit
                </a>
                @endrole

            </div>
            <div class="card">
                <div class="card-header">
                    <div class="float-left mr-3">
                        <div class="row">
                            <div class="col-12">
                                <select wire:change="row($event.target.value)" class="form-control rounded shadow-sm mr-3">
                                    <option value="1">1</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
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
                                    <th>Mitra</th>
                                    <th>Judul Pekerjaan</th>
                                    <th>Lokasi</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Durasi</th>
                                    <th style="width: 7rem;">Options</th>
                                </tr>
                                @forelse ($mitra as $index => $ts)
                                <tr>
                                    <td>{{ $mitra->firstItem() + $index }}</td>
                                    <td>{{ $ts->mitra }}</td>
                                    <td>{{ $ts->judulpekerjaan }}</td>
                                    <td>{{ $ts->lokasi }}</td>
                                    <td>{{ $ts->tglawal }}</td>
                                    <td>{{ $ts->tglakhir }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('detailworking.detail', $ts) }}" class="btn btn-info btn-sm text-white"><i class="fas fa-eye mr-2"></i>Detail</a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr class="text-center">
                                    <td colspan="9">
                                        <img src="https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/v2/assets/empty.svg" alt="No results found">
                                        <p class="mt-2">No Results Found</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        {!! $mitra->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>