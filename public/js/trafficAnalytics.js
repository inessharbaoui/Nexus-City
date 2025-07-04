document.addEventListener("DOMContentLoaded", function () {
    var ctxTraffic = document
        .getElementById("trafficByLocationChart")
        .getContext("2d");
    var trafficByLocationChart = new Chart(ctxTraffic, {
        type: "bar",
        data: {
            labels: JSON.parse(
                document.getElementById("trafficByLocationChart").dataset.labels
            ),
            datasets: [
                {
                    label: "Traffic Density by Location",
                    data: JSON.parse(
                        document.getElementById("trafficByLocationChart")
                            .dataset.data
                    ),
                    backgroundColor: "rgba(54, 162, 235, 0.2)",
                    borderColor: "rgba(54, 162, 235, 1)",
                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
            plugins: {
                legend: {
                    display: true,
                    position: "top",
                },
                title: {
                    display: true,
                    text: "Traffic Density by Location",
                },
            },
        },
    });

    var ctxSpeed = document
        .getElementById("averageSpeedByLocationChart")
        .getContext("2d");
    var averageSpeedByLocationChart = new Chart(ctxSpeed, {
        type: "line",
        data: {
            labels: JSON.parse(
                document.getElementById("averageSpeedByLocationChart").dataset
                    .labels
            ),
            datasets: [
                {
                    label: "Average Speed by Location",
                    data: JSON.parse(
                        document.getElementById("averageSpeedByLocationChart")
                            .dataset.data
                    ),
                    backgroundColor: "rgba(255, 99, 132, 0.2)",
                    borderColor: "rgba(255, 99, 132, 1)",
                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
            plugins: {
                legend: {
                    display: true,
                    position: "top",
                },
                title: {
                    display: true,
                    text: "Average Speed by Location",
                },
            },
        },
    });

    var ctxVehicleCount = document
        .getElementById("vehicleCountByHourChart")
        .getContext("2d");
    var vehicleCountByHourChart = new Chart(ctxVehicleCount, {
        type: "line",
        data: {
            labels: JSON.parse(
                document.getElementById("vehicleCountByHourChart").dataset
                    .labels
            ),
            datasets: [
                {
                    label: "Vehicle Count by Hour",
                    data: JSON.parse(
                        document.getElementById("vehicleCountByHourChart")
                            .dataset.data
                    ),
                    backgroundColor: "rgba(75, 192, 192, 0.2)",
                    borderColor: "rgba(75, 192, 192, 1)",
                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
            plugins: {
                legend: {
                    display: true,
                    position: "top",
                },
                title: {
                    display: true,
                    text: "Vehicle Count by Hour",
                },
            },
        },
    });

    var ctxSpeedDist = document
        .getElementById("speedDistributionChart")
        .getContext("2d");
    var speedDistributionChart = new Chart(ctxSpeedDist, {
        type: "pie",
        data: {
            labels: [
                "0-20 km/h",
                "21-40 km/h",
                "41-60 km/h",
                "61-80 km/h",
                "81+ km/h",
            ],
            datasets: [
                {
                    label: "Speed Distribution",
                    data: JSON.parse(
                        document.getElementById("speedDistributionChart")
                            .dataset.data
                    ),
                    backgroundColor: [
                        "rgba(255, 99, 132, 0.2)",
                        "rgba(54, 162, 235, 0.2)",
                        "rgba(255, 206, 86, 0.2)",
                        "rgba(75, 192, 192, 0.2)",
                        "rgba(153, 102, 255, 0.2)",
                    ],
                    borderColor: [
                        "rgba(255, 99, 132, 1)",
                        "rgba(54, 162, 235, 1)",
                        "rgba(255, 206, 86, 1)",
                        "rgba(75, 192, 192, 1)",
                        "rgba(153, 102, 255, 1)",
                    ],
                    borderWidth: 1,
                },
            ],
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: "top",
                },
                title: {
                    display: true,
                    text: "Speed Distribution",
                },
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 10,
                    bottom: 10,
                },
            },
        },
    });

    function createChart(elementId, labels, data, label) {
        var ctx = document.getElementById(elementId).getContext("2d");
        var chart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: labels,
                datasets: [
                    {
                        label: label,
                        data: data,
                        backgroundColor: [
                            "rgba(255, 99, 132, 0.2)",
                            "rgba(54, 162, 235, 0.2)",
                            "rgba(255, 206, 86, 0.2)",
                            "rgba(75, 192, 192, 0.2)",
                            "rgba(153, 102, 255, 0.2)",
                            "rgba(255, 159, 64, 0.2)",
                        ],
                        borderColor: [
                            "rgba(255, 99, 132, 1)",
                            "rgba(54, 162, 235, 1)",
                            "rgba(255, 206, 86, 1)",
                            "rgba(75, 192, 192, 1)",
                            "rgba(153, 102, 255, 1)",
                            "rgba(255, 159, 64, 1)",
                        ],
                        borderWidth: 1,
                    },
                ],
            },
            options: {
                scales: {
                    yAxes: [
                        {
                            ticks: {
                                beginAtZero: true,
                            },
                        },
                    ],
                },
            },
        });
    }

    var trafficByLocationChart = document.getElementById(
        "trafficByLocationChart"
    );
    if (trafficByLocationChart) {
        var locationLabels = trafficByLocationChart
            .getAttribute("data-labels")
            .split(",");
        var locationData = trafficByLocationChart
            .getAttribute("data-data")
            .split(",")
            .map(Number);
        createChart(
            "trafficByLocationChart",
            locationLabels,
            locationData,
            "Vehicle Count"
        );
    }

    var averageSpeedByLocationChart = document.getElementById(
        "averageSpeedByLocationChart"
    );
    if (averageSpeedByLocationChart) {
        var speedLabels = averageSpeedByLocationChart
            .getAttribute("data-labels")
            .split(",");
        var speedData = averageSpeedByLocationChart
            .getAttribute("data-data")
            .split(",")
            .map(Number);
        createChart(
            "averageSpeedByLocationChart",
            speedLabels,
            speedData,
            "Average Speed (km/h)"
        );
    }

    var vehicleCountByHourChart = document.getElementById(
        "vehicleCountByHourChart"
    );
    if (vehicleCountByHourChart) {
        var hourLabels = vehicleCountByHourChart
            .getAttribute("data-labels")
            .split(",");
        var hourData = vehicleCountByHourChart
            .getAttribute("data-data")
            .split(",")
            .map(Number);
        createChart(
            "vehicleCountByHourChart",
            hourLabels,
            hourData,
            "Vehicle Count"
        );
    }

    var speedDistributionChart = document.getElementById(
        "speedDistributionChart"
    );
    if (speedDistributionChart) {
        var distributionLabels = [
            "0-20 km/h",
            "21-40 km/h",
            "41-60 km/h",
            "61-80 km/h",
            "81+ km/h",
        ];
        var distributionData = speedDistributionChart
            .getAttribute("data-data")
            .split(",")
            .map(Number);
        createChart(
            "speedDistributionChart",
            distributionLabels,
            distributionData,
            "Vehicle Count"
        );
    }
});
