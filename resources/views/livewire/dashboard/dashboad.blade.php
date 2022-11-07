<div>
    <!-- BAR CHART -->
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="info-box3">
                <span class="info-box-icon3 bg-hijau"><span>{{now()->format('d')}}</span></span>
                <div class="info-box-content3">
                    <span class="info-box-number3">{{now()->format('M-Y')}}</span>
                    <span class="info-box-text3" id="waktu"></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="info-box2">
                <span class="info-box-icon2 bg-primary"><i class="fa fa-user-plus"></i></span>
                <div class="info-box-content2">
                    <span class="info-box-number2">{{$totaltamu}}</span>
                    <span class="info-box-text2">VISITORS TIME IN TODAY</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="info-box1">
                <span class="info-box-icon1 bg-secondary"><i class="fa fa-user-minus"></i></span>
                <div class="info-box-content1">
                    <span class="info-box-number1">{{$cekout}}</span>
                    <span class="info-box-text1">VISITORS TIME OUT TODAY</span>
                </div>
            </div>
        </div>
    </div>
    @push('js')
    <!-- ChartJS -->
    <script type="text/javascript">
        window.setTimeout("waktu()", 1000);
        function waktu() {
            var date = new Date();
            var hours = date.getHours();
            var result = date.toTimeString()
            var ampm = hours >= 12 ? 'PM' : 'AM';
            var strTime = result.slice(0, 8) + ' ' + ampm;
            setTimeout("waktu()", 1000);
            document.getElementById("waktu").innerHTML = strTime;
        }
    </script>

    @endpush
</div>