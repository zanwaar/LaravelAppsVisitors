<div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form wire:submit.prevent="updateSetting">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">General Setting</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="siteTitle">Title Website</label>
                                            <input wire:model.defer="state.site_title" type="text" class="form-control" id="siteTitle" placeholder="Enter site title">
                                        </div>
                                        <div class="form-group">
                                            <label for="siteName">Nama Aplikasi</label>
                                            <input wire:model.defer="state.site_name" type="text" class="form-control" id="siteName" placeholder="Enter site name">
                                        </div>
                                        <div class="form-group">
                                            <label for="siteEmail">Email Website</label>
                                            <input wire:model.defer="state.site_email" type="email" class="form-control" id="siteEmail" placeholder="Enter site email">
                                        </div>
                                        <div class="form-group">
                                            <label for="footerText">Footer Text</label>
                                            <input wire:model.defer="state.footer_text" type="text" class="form-control" id="footerText" placeholder="Enter footer text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="customFile">Logo Website</label>
                                            <div class="custom-file">
                                                <div x-data="{ isUploading: false, progress: 5 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false; progress = 5" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                    <input wire:model="logo" type="file" class="custom-file-input" id="customFile">
                                                    <div x-show.transition="isUploading" class="progress progress-sm mt-2 rounded">
                                                        <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`">
                                                            <span class="sr-only">40% Complete (success)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label class="custom-file-label" for="customFile">
                                                    @if ($logo)
                                                    {{ $logo->getClientOriginalName() }}
                                                    @else
                                                    Choose Image
                                                    @endif
                                                </label>
                                            </div>

                                            @if ($logo)
                                            <img src="{{ $logo->temporaryUrl() }}" class="img d-block mt-2 rounded" height="100px" width="100px">
                                            @else
                                            <img src="{{ setting('logo_url') ?? '' }}" class="img d-block mt-2 rounded" height="100px" width="100px">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input wire:model.defer="state.sidebar_collapse" type="checkbox" class="custom-control-input" id="sidebarCollapse">
                                        <label class="custom-control-label" for="sidebarCollapse">Sidebar Collapse</label>
                                    </div>
                                    <label for="sidebar_collapse">Sidebar Collapse</label><br>
                                    <input wire:model.defer="state.sidebar_collapse" type="checkbox" id="sidebar_collapse">
                                </div> -->

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

@push('js')
<script>
    $('#sidebarCollapse').on('change', function() {
        $('body').toggleClass('sidebar-collapse');
    })
</script>
@endpush