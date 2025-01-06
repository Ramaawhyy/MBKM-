@extends('template/tempkaprodi')

@section('content')
<div class="card">
    <div class="card-body">
    @if(Auth::user()->role == 'superadm')
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