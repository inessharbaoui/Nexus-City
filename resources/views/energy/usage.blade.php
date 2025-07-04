@extends('layouts.app')

@section('title', 'Energy Usage Details')

@section('content')
<div class="container">

    <button onclick="history.back()" class="btn btn-secondary mb-3 go-back-button">
        <i class="fas fa-arrow-left"></i> Go Back
    </button>


    <h1 class="mb-4">Energy Usage for {{ $usage->location }}</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="chart-card">
                <canvas id="electricityChart"></canvas>
                <div class="chart-description" id="electricityDescription">Loading...</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="chart-card">
                <canvas id="waterChart"></canvas>
                <div class="chart-description" id="waterDescription">Loading...</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="chart-card">
                <canvas id="gasChart"></canvas>
                <div class="chart-description" id="gasDescription">Loading...</div>
            </div>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header">
            <i class="fas fa-lightbulb"></i> Energy Saving Tips
        </div>
        <div class="card-body">
            <h5><i class="fas fa-bolt"></i> Save Electricity:</h5>
            <ul>
                <li>Turn off lights when not in use.</li>
                <li>Use energy-efficient appliances.</li>
                <li>Unplug electronics when not in use.</li>
            </ul>

            <h5><i class="fas fa-tint"></i> Save Water:</h5>
            <ul>
                <li>Fix leaks promptly.</li>
                <li>Take shorter showers.</li>
                <li>Install water-saving devices.</li>
            </ul>

            <h5><i class="fas fa-fire"></i> Save Gas:</h5>
            <ul>
                <li>Use a programmable thermostat.</li>
                <li>Insulate your home.</li>
                <li>Use energy-efficient heating systems.</li>
            </ul>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header">Detailed Insights</div>
        <div class="card-body" id="detailedInsights">
            Loading detailed insights...
        </div>
        <button id="exportBtn" class="btn btn-primary mt-3">Export Data as CSV</button>
    </div>


</div>
@endsection

@section('styles')
<style>
    .chart-card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
        text-align: center;
    }

    .chart-description {
        margin-top: 20px;
        font-size: 14px;
        color: #555;
    }

    .card-header {
        font-size: 18px;
        background-color: #4e73df;
        color: white;
        border-bottom: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-body h5 {
        margin-top: 20px;
        font-size: 16px;
        color: #333;
    }

    .card-body ul {
        list-style-type: none;
        padding: 0;
    }

    .card-body ul li {
        margin-bottom: 10px;
        padding-left: 25px;
        position: relative;
    }

    .card-body ul li:before {
        content: '\f00c';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        left: 0;
        top: 0;
        color: #1cc88a;
    }

    .btn-primary {
        background-color: #1cc88a;
        border-color: #1cc88a;
    }

    .btn-primary:hover {
        background-color: #17a673;
        border-color: #17a673;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const usage = @json($usage);
        const colors = ['#ff69b4', '#1e90ff', '#adff2f'];

        function getDescription(usageValue, maxValue, type) {
            const remaining = maxValue - usageValue;
            let adviceClass = '';
            let adviceIcon = '';
            let advice = '';

            if (usageValue > maxValue * 0.8) {
                adviceClass = 'alert-danger';
                adviceIcon = 'fas fa-exclamation-circle';
                advice = 'Warning: High usage! Consider reducing consumption.';
            } else if (usageValue < maxValue * 0.2) {
                adviceClass = 'alert-info';
                adviceIcon = 'fas fa-info-circle';
                advice = 'Notification: Low usage. Ensure systems are operating efficiently.';
            } else {
                adviceClass = 'alert-success';
                adviceIcon = 'fas fa-check-circle';
                advice = 'Usage is within expected range.';
            }

            return `<div class="alert ${adviceClass}"><i class="${adviceIcon}"></i> Current ${type} Usage: ${usageValue} (Max: ${maxValue})<br>Remaining ${type}: ${remaining}<br>${advice}</div>`;
        }

        const chartOptions = {
            type: 'pie',
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            const label = context.label || '';
                            return `${label}: ${context.raw}`;
                        }
                    }
                },
                legend: {
                    display: true,
                    position: 'bottom',
                },
                datalabels: {
                    color: '#ffffff',
                    anchor: 'center',
                    align: 'center',
                    offset: 0,
                    font: {
                        size: 14,
                    },
                    formatter: (value, context) => {
                        return context.chart.data.labels[context.dataIndex] + ': ' + value;
                    }
                },
            },
            responsive: true,
            maintainAspectRatio: false,
        };

        const electricityChart = new Chart(document.getElementById('electricityChart'), {
            ...chartOptions,
            data: {
                labels: ['Electricity Usage', 'Remaining'],
                datasets: [{
                    data: [usage.electricity_usage, 1000 - usage.electricity_usage],
                    backgroundColor: [colors[0], '#f0f0f0'],

                }]
            }
        });



const waterChart = new Chart(document.getElementById('waterChart'), {
    ...chartOptions,
    data: {
        labels: ['Water Usage', 'Remaining'],
        datasets: [{
            data: [usage.water_usage, 5000 - usage.water_usage],
            backgroundColor: [colors[1], '#f0f0f0'],
        }]
    }
});

const gasChart = new Chart(document.getElementById('gasChart'), {
    ...chartOptions,
    data: {
        labels: ['Gas Usage', 'Remaining'],
        datasets: [{
            data: [usage.gas_usage, 50 - usage.gas_usage],
            backgroundColor: [colors[2], '#f0f0f0'],
        }]
    }
});

document.getElementById('electricityDescription').innerHTML = getDescription(usage.electricity_usage, 1000, 'Electricity');
document.getElementById('waterDescription').innerHTML = getDescription(usage.water_usage, 5000, 'Water');
document.getElementById('gasDescription').innerHTML = getDescription(usage.gas_usage, 50, 'Gas');

function generateInsights() {
    const insights = `
        <p>This location electricity usage is ${usage.electricity_usage} kWh, which is ${usage.electricity_usage > 800 ? 'high' : 'within the expected range'}.</p>
        <p>This location water usage is ${usage.water_usage} liters, which is ${usage.water_usage > 4000 ? 'high' : 'within the expected range'}.</p>
        <p>This location gas usage is ${usage.gas_usage} cubic meters, which is ${usage.gas_usage > 40 ? 'high' : 'within the expected range'}.</p>
    `;
    document.getElementById('detailedInsights').innerHTML = insights;
}

generateInsights();

document.getElementById('exportBtn').addEventListener('click', function () {
    const csvContent = `data:text/csv;charset=utf-8,
        Type,Usage,Remaining
        Electricity,${usage.electricity_usage},${1000 - usage.electricity_usage}
        Water,${usage.water_usage},${5000 - usage.water_usage}
        Gas,${usage.gas_usage},${50 - usage.gas_usage}
    `;
    const encodedUri = encodeURI(csvContent);
    const link = document.createElement('a');
    link.setAttribute('href', encodedUri);
    link.setAttribute('download', 'energy_usage_data.csv');
    document.body.appendChild(link);
    link.click();
});
});
</script>
@endsection
