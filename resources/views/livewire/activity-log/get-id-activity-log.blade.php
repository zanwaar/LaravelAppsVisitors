<div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Activity</h4>
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
                        <th>{{ $log->firstItem() + $index  }}</th>
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