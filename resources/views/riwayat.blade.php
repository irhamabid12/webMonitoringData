<div class="container">
    <title>Dashboard</title>
    <h4 class="fw-bold mb-5">Riwayat</h4>

    <div class="container">
        <ul class="nav nav-pills mb-3 justify-content-center" id="riwayat-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-oneday-tab" data-bs-toggle="pill" type="button" role="tab"
                    data-bs-target="#pills-oneday" aria-controls="pills-home" aria-selected="true">Harian</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-annually-tab" data-bs-toggle="pill" type="button" role="tab"
                    data-bs-target="#pills-annually" aria-controls="pills-profile"
                    aria-selected="false">Bulanan</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-yearly-tab" data-bs-toggle="pill" type="button" role="tab"
                    data-bs-target="#pills-yearly" aria-controls="pills-contact" aria-selected="false">Tahunan</button>
            </li>
        </ul>
        <br>
        <div class="col-md-12 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-start">
                    <h3 class="fw-bold">12 Kali</h3>
                    <p class="card-text">Rata-Rata-Rata Tidur</p>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-start">
                    <h3 class="fw-bold">12 Kali</h3>
                    <p class="card-text">Rata-Rata Buzzer Dinonaktifkan</p>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-start">
                    <h3 class="fw-bold">12 Kali</h3>
                    <p class="card-text">Rata-Rata Buzzer Tidak Dinonaktifkan</p>
                </div>
            </div>
        </div>
        <br>
        <div class="tab-content" id="tabContent-riwayat">
            <div class="tab-pane fade" id="pills-oneday" role="tabpanel" aria-labelledby="pills-oneday-tab"
                tabindex="0">
                <canvas id="grafik-riwayat-harian"></canvas>
            </div>
            <div class="tab-pane fade show active" id="pills-annually" role="tabpanel" aria-labelledby="pills-annually-tab"
                tabindex="0">
                <canvas id="grafik-riwayat-bulanan"></canvas>
            </div>
            <div class="tab-pane fade" id="pills-yearly" role="tabpanel" aria-labelledby="pills-yearly-tab"
                tabindex="0">
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
                    <div class="col-md-12 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body text-start">
                                <span class="card-text"><b>20/12/2022 20:00:12</b></span><br>
                                <span class="card-text">Driver Status : Mengantuk</span><br>
                                <span class="card-text">Tombol Status : Ditekan</span><br>
                                <span class="card-text">Waktu Tombol Ditekan : 20/12/2022 20:00:12</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body text-start">
                                <span class="card-text"><b>20/12/2022 20:00:12</b></span><br>
                                <span class="card-text">Driver Status : Mengantuk</span><br>
                                <span class="card-text">Tombol Status : Ditekan</span><br>
                                <span class="card-text">Waktu Tombol Ditekan : 20/12/2022 20:00:12</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('grafik-riwayat-bulanan');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                'Oktober', 'November', 'Desember'
            ],
            datasets: [{
                data: [12, 19, 3, 5, 2, 3, 4, 5, 6, 7, 8, 9],
                borderWidth: 1,
                backgroundColor: ['#FF2D20', '#FF2D20', '#FF2D20', '#FF2D20', '#FF2D20', '#FF2D20',
                    '#FF2D20', '#FF2D20', '#FF2D20', '#FF2D20', '#FF2D20', '#FF2D20', '#FF2D20'
                ],
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
                },
                colors: {
                    enabled: true
                }
            }
        }
    });
</script>
