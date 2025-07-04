@extends('layouts.app')

@section('title', 'Energy Consumption')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h1 class="text-center mb-4">Energy Consumption Data</h1>
                    <div class="chart-container" style="position: relative; height:500px; width:100%;">
                        <canvas id="burnupChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h2 class="text-center mb-3">Locations</h2>
                    <div class="list-group">
                        @foreach($energyUsages as $usage)
                        <div id="location-{{ $usage->id }}" class="location-container">
                            <a href="{{ route('usage.show', ['id' => $usage->id]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                {{ $usage->location }}
                                <span class="badge badge-primary badge-pill insights-btn">Insights</span>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const energyUsages = @json($energyUsages);
        const cumulativeEnergy = energyUsages.map(usage => ({
            date: new Date(usage.recorded_at),
            total: usage.electricity_usage + usage.water_usage + usage.gas_usage
        }));

        const labels = cumulativeEnergy.map(data => data.date.toLocaleDateString());
        const data = cumulativeEnergy.map(data => data.total);

        const ctx = document.getElementById('burnupChart').getContext('2d');
        const burnupChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Cumulative Energy Consumption',
                    data: data,
                    borderColor: '#4CAF50',
                    backgroundColor: 'rgba(76, 175, 80, 0.2)',
                    borderWidth: 3,
                    pointRadius: 5,
                    pointBackgroundColor: '#4CAF50',
                    pointBorderColor: '#fff',
                    pointHoverRadius: 7,
                    pointHoverBackgroundColor: '#4CAF50',
                    pointHoverBorderColor: '#fff',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Burnup Chart: Cumulative Energy Consumption',
                        font: {
                            size: 18,
                            weight: 'bold'
                        }
                    },
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: true,
                        mode: 'nearest',
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleFont: {
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 12
                        },
                        callbacks: {
                            label: function (tooltipItem) {
                                return tooltipItem.raw.toFixed(2);
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date',
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Energy Consumption',
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        },
                        ticks: {
                            beginAtZero: true,
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });
    });
</script>

<style>
    .insights-btn {
        background-color: black;
        color: white;
    }

    .chart-container {
        height: 500px;
        width: 100%;
    }
</style>
@endsection
