<div>
    <div class="row">


        <div class="col-md-8">
            <div class="card ">
                <!-- <div class="card-header">
                    <div class="float-right">
                        <div class="btn-group">

                        </div>
                    </div>

                </div> -->
                <div class="card-body">
                    <div class="chart">
                        @if (isset($value))
                        <canvas id="myChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            
                        @else
                            <p>Tidak Ada Pengunjung</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <!-- <a href="{{ route('tambahtamu') }}" type="button" class="btn btn-info btn-block mb-3 text-white">
                <i class="fa fa-plus-circle mr-2"></i>Tambah Tamu
            </a> -->

            <div class="card">
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item active">
                            <a href="{{ route('listbarang')}}" class="nav-link">
                                <i class="fas fa-inbox mr-2"></i>Barang/Surat belum Diambil
                                <span class="badge bg-danger float-right">{{ $totalbarang }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tambahtamu')}}" class="nav-link">
                                <i class="fa fa-plus-circle mr-2"></i>Tambah Tamu
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tamu')}}" class="nav-link">
                                <i class="far fa-file-alt mr-2"></i>
                                Log Tamu <span class="badge bg-warning float-right">{{$totallogtamu}}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('daftartamu')}}" class="nav-link">
                                <i class="fa fa-solid fa-address-book mr-2"></i>Daftar Tamu
                                <span class="badge bg-info float-right">{{$totaltamu}}</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <!-- /.card-body -->
            </div>

        </div>
    </div>


    <!-- /.card-body -->
</div>
@push('js')
<!-- ChartJS -->
<script src="{{asset('/backend/plugins/chart.js/Chart.min.js')}}"></script>
<script type="text/javascript">
    var labels = @json($labels);
    var tamu = @json($value);

    const data = {
        labels: labels,
        datasets: [{
            label: 'Tahun 2022',
            backgroundColor: 'rgb(255, 213, 99)',
            borderColor: 'rgb(255, 213, 99)',
            data: tamu,
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false,
            scales: {
                xAxes: [{
                    stacked: true,
                }],
                yAxes: [{
                    stacked: true
                }]
            }
        }
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>

@endpush
</div>