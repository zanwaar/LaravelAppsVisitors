@props(['placeholder' => 'Select Options', 'id'])

<div wire:ignore>
    <select {{ $attributes }} id="{{ $id }}" data-placeholder="{{ $placeholder }}" style="width: 100%;">
        {{ $slot }}
    </select>
</div>

@once
@push('styles')
<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endpush
@endonce

@once
@push('js')
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush
@endonce

@push('js')
<script>
    $(document).ready(function() {
        $('#{{ $id }}').select2({
            theme: 'bootstrap4',
        })
    });
    $('form').submit(function() {
        @this.set('state.bagian_id', $('#{{ $id }}').val());
    })
</script>
@endpush