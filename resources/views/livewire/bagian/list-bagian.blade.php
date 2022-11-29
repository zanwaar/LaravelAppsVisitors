<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Daftar Bagian</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Bagian</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">
                    <div class="float-left mr-3">
                        <div class="row">
                            <div class="col-12">
                                <select wire:change="row($event.target.value)" class="form-control rounded shadow-sm mr-3">
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
                    <div class="btn-group shadow-sm btn-group">
                        <button wire:click.prevent="addNew" class="btn btn-info"><i class="fa fa-plus-circle mr-1"></i>Tambah Bagian</button>

                        <button type="button" class="btn btn-default" data-toggle="modal" wire:click.prevent="swohimport()">Import Excel</button>
                        <button wire:click.prevent="export" type="button" class="btn btn-default ">Export Excel</button>
                    </div>
                    <div class="float-right">
                        <div class="btn-group">
                            <div class=" input-group input-group-sm">
                                <x-search-input wire:model="searchTerm" />
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-responsive-md table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Tenant</th>
                                <th scope="col">Penanggung Jawab</th>
                                <th scope="col">Tlpn</th>
                                <th scope="col">Email</th>
                                <th scope="col">Lantai Tenant</th>
                                <th style="width: 8px;">Options</th>
                            </tr>
                        </thead>
                        <tbody wire:loading.class="text-muted">
                            @forelse ($bagian as $index => $bg)
                            <tr>

                                <td>{{ $bagian->firstItem() + $index }}</td>
                                <td>{{ $bg->namaTenant }}</td>
                                <td>{{ $bg->penanggungJawab}}</td>
                                <td>{{ $bg->tlpn}}</td>
                                <td>{{ $bg->email}}</td>
                                <td>{{ $bg->lantaiTenant }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="#" wire:click.prevent="edit({{ $bg }})" class="btn btn-info btn-sm text-white"><i class="fa fa-edit"></i></a>
                                        <a href="#" wire:click.prevent=" confirmRemoval({{ $bg }})" class="btn btn-danger text-white"><i class="fas fa-trash"></i></a>
                                    </div>
                                </td>
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
                </div>
                <div class="card-footer d-flex justify-content-end">
                    {!! $bagian->links() !!}
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

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
                            <label for="namaTenant">Nama Tenant</label>
                            <input type="text" wire:model.defer="state.namaTenant" class="form-control @error('namaTenant') is-invalid @enderror" id="namaTenant" aria-describedby="nameHelp" placeholder="Enter Nama Tenant">
                            @error('namaTenant')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="penanggungJawab">Penanggung Jawab</label>
                            <input type="text" wire:model.defer="state.penanggungJawab" class="form-control @error('penanggungJawab') is-invalid @enderror" id="penanggungJawab" aria-describedby="nameHelp" placeholder="Enter Penanggung Jawab">
                            @error('penanggungJawab')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tlpn">Tlpn</label>
                            <input type="text" wire:model.defer="state.tlpn" class="form-control @error('tlpn') is-invalid @enderror" id="tlpn" aria-describedby="nameHelp" placeholder="Enter Tlpn">
                            @error('tlpn')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" wire:model.defer="state.email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="nameHelp" placeholder="Enter Email">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="lantaiTenant">Lantai Tenant</label>
                            <input type="text" wire:model.defer="state.lantaiTenant" class="form-control @error('lantaiTenant') is-invalid @enderror" id="lantaiTenant" aria-describedby="nameHelp" placeholder="Enter Lantai Tenant">
                            @error('lantaiTenant')
                            <div class="invalid-feedback">
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

    <!-- Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
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

    <!-- Modal -->
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form autocomplete="off" wire:submit.prevent="import">
                    <div class="modal-header">
                        <h5>Import</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="customFile">File Import</label>
                            <div class="custom-file">
                                <div x-data="{ isUploading: false, progress: 5 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false; progress = 5" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <input wire:model="fileimport" type="file" class="custom-file-input is-invalid" id="customFile">
                                    <div x-show.transition="isUploading" class="progress progress-sm mt-2 rounded">
                                        <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                                <label class="custom-file-label" for="customFile">
                                    @if ($fileimport)
                                    {{ $fileimport->getClientOriginalName() }}
                                    @else
                                    Choose File
                                    @endif
                                </label>
                                @error('fileimport')
                                <div class="text-danger p">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <a href="" wire:click.prevent="downloadfileimport" class="text-primary"> Download Format File Import</a>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>Import</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>