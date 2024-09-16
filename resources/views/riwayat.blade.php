<h4 class="fw-bold mb-5 mt-5">Riwayat</h4>
<div class="card mt-5">
    <div class="navigator-tab-riwayat mt-3">
        <ul class="nav nav-pills mb-3 justify-content-center" id="riwayat-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-oneday-tab" data-bs-toggle="pill" type="button" role="tab"
                    data-bs-target="#pills-oneday" aria-controls="pills-home" aria-selected="true" onclick="getRiwayatHarian()">Harian</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-annually-tab" data-bs-toggle="pill" type="button" role="tab" 
                    data-bs-target="#pills-annually" aria-controls="pills-profile" aria-selected="false" onclick="getRiwayatBulanan()">Bulanan</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-yearly-tab" data-bs-toggle="pill" type="button" role="tab"
                    data-bs-target="#pills-yearly" aria-controls="pills-contact" aria-selected="false" onclick="getRiwayatTahunan()">Tahunan</button>
            </li>
        </ul>
    </div>
    <br>
    <div class="card-body" style="max-height: 80vh; overflow-y: auto">
        
        <div class="tab-content" id="tabContent-riwayat">
            <div class="tab-pane fade show active" id="pills-oneday" role="tabpanel" aria-labelledby="pills-oneday-tab" tabindex="0">
                <div class="row">
                    <div class="col text-start">
                        <!-- Input Pilihan Bulan -->
                        <label class="form-label" for="month"><b>Pilih Bulan</b></label>
                        <select class="form-select" name="month" id="month" onchange="getRiwayatHarian()">
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="col text-start">
                        <!-- Input Pilihan Tahun -->
                        <label class="form-label" for="year-harian"><b>Pilih Tahun</b></label>
                        <select class="form-select" name="year" id="year-harian" onchange="getRiwayatHarian()">
                            @for($i = date('Y'); $i >= 1900; $i = $i - 1); $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <br>
                <div class="col-md-12 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body text-start">
                            <h3 class="fw-bold"><span id="totalSleepHarian">0</span> Kali</h3>
                            <p class="card-text">Rata-Rata Tidur</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body text-start">
                            <h3 class="fw-bold"><span id="totalBuzzerHarian">0</span> Kali</h3>
                            <p class="card-text">Rata-Rata Buzzer Dinonaktifkan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body text-start">
                            <h3 class="fw-bold"><span id="totalNotBuzzerHarian">0</span> Kali</h3>
                            <p class="card-text">Rata-Rata Buzzer Tidak Dinonaktifkan</p>
                        </div>
                    </div>
                </div>
                <br>
                <canvas id="grafik-riwayat-harian"></canvas>
            </div>
            <div class="tab-pane fade" id="pills-annually" role="tabpanel" aria-labelledby="pills-annually-tab" tabindex="0">
                <div class="col text-start">
                    <!-- Input Pilihan Tahun -->
                    <label class="form-label" for="year"><b>Pilih Tahun</b></label>
                    <select class="form-select" name="year" id="year" onchange="getRiwayatBulanan()">
                        @for($i = date('Y'); $i >= 1900; $i = $i - 1); $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <br>
                <div class="col-md-12 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body text-start">
                            <h3 class="fw-bold"><span id="totalSleepBulanan">0</span> Kali</h3>
                            <p class="card-text">Rata-Rata Tidur</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body text-start">
                            <h3 class="fw-bold"><span id="totalBuzzerBulanan">0</span> Kali</h3>
                            <p class="card-text">Rata-Rata Buzzer Dinonaktifkan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body text-start">
                            <h3 class="fw-bold"><span id="totalNotBuzzerBulanan">0</span> Kali</h3>
                            <p class="card-text">Rata-Rata Buzzer Tidak Dinonaktifkan</p>
                        </div>
                    </div>
                </div>
                <br>
                <canvas id="grafik-riwayat-bulanan"></canvas>
            </div>
            <div class="tab-pane fade" id="pills-yearly" role="tabpanel" aria-labelledby="pills-yearly-tab" tabindex="0">
                <div class="row">
                    <div class="col text-start">
                        <!-- Input Pilihan Tahun -->
                        <label class="form-label" for="start-year"><b>Pilih Tahun Awal</b></label>
                        <select class="form-select" name="start-year" id="start-year" onchange="getRiwayatTahunan()">
                            @for($i = date('Y'); $i >= 1900; $i = $i - 1); $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col text-start">
                        <!-- Input Pilihan Tahun -->
                        <label class="form-label" for="end-year"><b>Pilih Tahun Akhir</b></label>
                        <select class="form-select" name="end-year" id="end-year" onchange="getRiwayatTahunan()">
                            @for($i = date('Y'); $i >= 1900; $i = $i - 1); $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <br>
                <div class="col-md-12 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body text-start">
                            <h3 class="fw-bold"><span id="totalSleepTahunan">0</span> Kali</h3>
                            <p class="card-text">Rata-Rata Tidur</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body text-start">
                            <h3 class="fw-bold"><span id="totalBuzzerTahunan">0</span> Kali</h3>
                            <p class="card-text">Rata-Rata Buzzer Dinonaktifkan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body text-start">
                            <h3 class="fw-bold"><span id="totalNotBuzzerTahunan">0</span> Kali</h3>
                            <p class="card-text">Rata-Rata Buzzer Tidak Dinonaktifkan</p>
                        </div>
                    </div>
                </div>
                <br>
                <canvas id="grafik-riwayat-tahunan"></canvas>
            </div>
        </div>
        <br>
        <div id="detail-riwayat">
            <p class="d-inline-flex gap-1">
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#detaildatariwayat" aria-expanded="false" aria-controls="detaildatariwayat">
                  Detail Data
                </button>
            </p>
            <div class="collapse" id="detaildatariwayat">
                <div class="card card-body">
                    <div id="detail-riwayat-data"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function getRiwayatHarian() {
        var month = $("#month").val();
        var year = $("#year-harian").val();
        $('#detail-riwayat-data').empty();

        $.ajax({
            type: "GET",
            url: "{{ route('index.riwayat.getRiwayatHarian') }}",
            data: {
                'month': month,
                'year': year
            },
            success: function(data) {
                $('#totalSleepHarian').text(data.average ?? 0);
                $('#totalBuzzerHarian').text(data.tekan ?? 0);
                $('#totalNotBuzzerHarian').text(data.tidaktekan ?? 0);
                drawChart(data, 'grafik-riwayat-harian');

                if (data.detail.length != 0) {
                    $.each(data.detail, function(key, value) {
                        $('#detail-riwayat-data').append(
                            `<div class="col-md-12 mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-body text-start">
                                        <span class="card-text"><b>${value.created_at}</b></span><br>
                                        <span class="card-text">Driver Status : ${value.driver_status}</span><br>
                                        <span class="card-text">Tombol Status : ${value.tombol_status}</span><br>
                                        <span class="card-text">Waktu Tombol Ditekan : ${value.created_at}</span>
                                    </div>
                                </div>
                            </div>`
                        );
                    });
                } else {
                    $('#detail-riwayat-data').append(`<img src="{{ asset('assets/images/no-data.png') }}" width="50%"><p class="text-center mt-3 fw-bold">Tidak ada data</p>`);
                }
            }
        });
    }

    function getRiwayatBulanan() {
        var year = $("#year").val();
        $('#detail-riwayat-data').empty();

        $.ajax({
            type: "GET",
            url: "{{ route('index.riwayat.getRiwayatBulanan') }}",
            data: {
                'year': year
            },
            success: function(data) {
                $('#totalSleepBulanan').text(data.average ?? 0);
                $('#totalBuzzerBulanan').text(data.averageTekan ?? 0);
                $('#totalNotBuzzerBulanan').text(data.averageTidakTekan ?? 0);
                drawChart(data, 'grafik-riwayat-bulanan');

                if (data.detail.length != 0) {
                    $.each(data.detail, function(key, value) {
                        $('#detail-riwayat-data').append(
                            `<div class="col-md-12 mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-body text-start">
                                        <span class="card-text"><b>${value.created_at}</b></span><br>
                                        <span class="card-text">Driver Status : ${value.driver_status}</span><br>
                                        <span class="card-text">Tombol Status : ${value.tombol_status}</span><br>
                                        <span class="card-text">Waktu Tombol Ditekan : ${value.created_at}</span>
                                    </div>
                                </div>
                            </div>`
                        );
                    });
                } else {
                    $('#detail-riwayat-data').append(`<img src="{{ asset('assets/images/no-data.png') }}" width="50%"><p class="text-center mt-3 fw-bold">Tidak ada data</p>`);
                }
            }
        });
    }

    function getRiwayatTahunan() {
        var startyear = $("#start-year").val();
        var endyear = $("#end-year").val();
        $('#detail-riwayat-data').empty();
        $.ajax({
            type: "GET",
            url: "{{ route('index.riwayat.getRiwayatTahunan') }}",
            data: {
                'startyear': startyear,
                'endyear' : endyear
            },
            success: function(data) {                
                $('#totalSleepTahunan').text(data.average ?? 0);
                $('#totalBuzzerTahunan').text(data.average_tekan ?? 0);
                $('#totalNotBuzzerTahunan').text(data.average_tidak_tekan ?? 0);
                drawChart(data, 'grafik-riwayat-tahunan');

                if (data.detail.length != 0) {
                    $.each(data.detail, function(key, value) {
                        $('#detail-riwayat-data').append(
                            `<div class="col-md-12 mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-body text-start">
                                        <span class="card-text"><b>${value.created_at}</b></span><br>
                                        <span class="card-text">Driver Status : ${value.driver_status}</span><br>
                                        <span class="card-text">Tombol Status : ${value.tombol_status}</span><br>
                                        <span class="card-text">Waktu Tombol Ditekan : ${value.created_at}</span>
                                    </div>
                                </div>
                            </div>`
                        );
                    });
                } else {
                    $('#detail-riwayat-data').append(`<img src="{{ asset('assets/images/no-data.png') }}" width="50%"><p class="text-center mt-3 fw-bold">Tidak ada data</p>`);
                }
            }
        });
    }

    var chart = null;
    function drawChart(data, id) {
        const ctx = document.getElementById(id).getContext('2d');
        if (chart) {
            chart.destroy(); // Hapus chart sebelumnya jika ada
        }
        chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Nilai Bulanan',
                    data: data.data,
                    borderWidth: 1,
                    backgroundColor: '#FF2D20'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        display: false
                    }
                }
            }
        });
    }
</script>
