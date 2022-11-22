<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">User Activity</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">User Activity</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid pb-5">

            <div class="row">


                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="float-left mr-3">
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
                                        <h4 class="card-title mt-2">User Activity</h4>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <table class="table table-responsive-md table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">IP</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Date Time</th>
                                    </tr>
                                </thead>
                                <tbody wire:loading.class="text-muted">
                                    @forelse ($log as $index => $l)
                                    <tr>
                                        <th>{{ $log->firstItem() + $index }}</th>
                                        <td>{{ $l->ip }}</td>
                                        <td>{{ $l->description }}</td>
                                        <td>{{ $l->created_at }}</td>
                                    </tr>
                                    @empty
                                    <tr class="text-center">
                                        <td colspan="5">
                                            <img src="https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/v2/assets/empty.svg" alt="No results found">
                                            <p class="mt-2">No results found</p>
                                        </td>
                                    </tr>

                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            {!! $log->links() !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->




</div>