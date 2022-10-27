<div>
    <div class="card">
        <div class="card-header">
            <div class="float-left">
                <h4>Daftar Anggota</h4>
            </div>
            <div class="float-right">
                {!! $personil->links() !!}
            </div>
        </div>
        <div class="card-body p-0">
            <ul class="list-group">
                @forelse ($personil as $index => $ts)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div> <span class="mr-1">{{ $personil->firstItem() + $index }}
                        </span>
                        {{ $ts->nama }}
                    </div>
                    <div class="btn-group btn-group-sm">
                        <a href="#" wire:click.prevent="edit({{ $ts }})" class="btn btn-info text-white"><i class="fas fa-eye"></i></a>
                        <button type="button" wire:click.prevent="confirmRemoval({{ $ts }})" class="btn btn-danger text-white"><i class="fas fa-trash"></i></button>
                    </div>

                </li>
                @empty
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Tidak Anggota
                </li>
                @endforelse
            </ul>
        </div>
        <div class="card-footer">
            <div class="float-right">
            </div>
        </div>
    </div>
</div>