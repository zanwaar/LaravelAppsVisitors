<x-admin-layout>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <livewire:admin.dashboard.appointments-count />
                    <livewire:admin.dashboard.users-count />
                </div>
                <!-- <h1>Log Activity Lists</h1> -->
                <!-- <table class="table table-bordered">
          <tr>
            <th>No</th>
            <th>Subject</th>
            <th>URL</th>
            <th>Method</th>
            <th>Ip</th>
            <th width="300px">User Agent</th>
            <th>User Id</th>
            <th>Action</th>
          </tr>
          @if($logs->count())
          @foreach($logs as $key => $log)
          <tr>
            <td>{{ ++$key }}</td>
            <td>{{ $log->subject }}</td>
            <td class="text-success">{{ $log->url }}</td>
            <td><label class="label label-info">{{ $log->method }}</label></td>
            <td class="text-warning">{{ $log->ip }}</td>
            <td class="text-danger">{{ $log->agent }}</td>
            <td>{{ $log->user_id }}</td>
            <td><button class="btn btn-danger btn-sm">Delete</button></td>
          </tr>
          @endforeach
          @endif
        </table> -->

            </div>
        </div>
        <!-- /.content -->
    </div>
  
</x-admin-layout>