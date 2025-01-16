@extends('template/tempindex') <!-- Merujuk ke template utama -->

@section('content')
   
                    <div class="card">
                      <div class="card-body">
                      @if(Auth::user()->role == 'admin')
                      <div class="container mt-4">
                        <div class="row">
                            <div class="col-md-4">
                                <!-- Grafik Donut -->
                                <h5 class="text-center">MBKM Diambil</h5>
                                <div style="width: 100%; max-width: 300px; margin: auto;">
                                    <canvas id="donutChart"></canvas>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Grafik Pie -->
                                <h5 class="text-center">Grafik Pie - Program MBKM</h5>
                                <div style="width: 100%; max-width: 300px; margin: auto;">
                                    <canvas id="pieChart"></canvas>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-12">
                                        <!-- Grafik Batang -->
                                        <h5 class="text-center">Grafik Batang</h5>
                                        <div style="width: 100%; max-width: 400px; margin: auto;">
                                            <canvas id="barChart"></canvas>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <!-- Grafik Garis -->
                                        <h5 class="text-center">Grafik Garis</h5>
                                        <div style="width: 100%; max-width: 400px; margin: auto;">
                                            <canvas id="lineChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @endif
                    @endsection
                    
                    @section('scripts')
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        // Data dari controller
                        const programData = @json($programData);
                    
                        // Parsing data ke label dan total
                        const labels = programData.map(data => data.program_mbkm);
                        const totals = programData.map(data => data.total);
                    
                        // Grafik Donut
                        const donutCtx = document.getElementById('donutChart').getContext('2d');
                        new Chart(donutCtx, {
                            type: 'doughnut',
                            data: {
                                labels: labels,
                                datasets: [{
                                    data: totals,
                                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'],
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                    },
                                }
                            }
                        });
                    
                        // Grafik Pie
                        const pieCtx = document.getElementById('pieChart').getContext('2d');
                        new Chart(pieCtx, {
                            type: 'pie',
                            data: {
                                labels: labels,
                                datasets: [{
                                    data: totals,
                                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'],
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                    },
                                }
                            }
                        });
                    
                        // Grafik Batang
                        const barCtx = document.getElementById('barChart').getContext('2d');
                        new Chart(barCtx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Jumlah Program',
                                    data: totals,
                                    backgroundColor: '#36A2EB',
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    x: { title: { display: true, text: 'Program MBKM' } },
                                    y: { title: { display: true, text: 'Jumlah' }, beginAtZero: true }
                                }
                            }
                        });
                    
                        // Grafik Garis
                        const lineCtx = document.getElementById('lineChart').getContext('2d');
                        new Chart(lineCtx, {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Jumlah Program',
                                    data: totals,
                                    borderColor: '#FF6384',
                                    tension: 0.3,
                                    fill: false,
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    x: { title: { display: true, text: 'Program MBKM' } },
                                    y: { title: { display: true, text: 'Jumlah' }, beginAtZero: true }
                                }
                            }
                        });
                    </script>
                    @endsection  

     @section('cardatas')
     <div class="col-md-4 grid-margin">
              <div class="card text-white bg-success" style="background-image: url('{{ asset('img/hijau.png') }}'); border-radius: 20px; height: 80px; background-size: cover; background-position: center;">
                  <div class="card-body" style="display: flex; justify-content: space-between; align-items: center;">
                      <h5 class="card-title" style="margin: 0; font-weight: 600; color: white;">Approval Administrasi</h5>
                      <span class="badge badge-pill bg-dark" style="padding: 10px 15px; font-size: 16px; font-weight: 600;">{{ isset($approvedCount) ? $approvedCount : 0 }}</span>
                  </div>
              </div>
          </div>
        <div class="col-md-4 grid-margin">
          <div class="card text-white bg-danger" style="background-image: url('{{ asset('img/merah.png') }}'); border-radius: 20px; height: 80px; background-size: cover; background-position: center;">
              <div class="card-body" style="display: flex; justify-content: space-between; align-items: center;">
                  <h5 class="card-title" style="margin: 0; font-weight: 600; color: white;">Approval Matakuliah</h5>
                  <span class="badge badge-pill bg-dark" style="padding: 10px 15px; font-size: 16px; font-weight: 600;">{{ isset($rejectedCount) ? $rejectedCount : 0 }}</span>
              </div>
          </div>
      </div>
     @endsection  