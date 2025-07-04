function generateGradientColor(temperature) {
    var warmColor = "rgba(255, 100, 0, 0.7)";
    var coolColor = "rgba(0, 100, 255, 0.7)";

    var minTemperature = -10;
    var maxTemperature = 40;
    var temperatureRange = maxTemperature - minTemperature;
    var temperaturePercent = (temperature - minTemperature) / temperatureRange;

    var color;
    if (temperaturePercent < 0) {
        color = coolColor;
    } else if (temperaturePercent > 1) {
        color = warmColor;
    } else {
        var r = Math.round(
            (1 - temperaturePercent) * parseInt(coolColor.substring(4, 7)) +
                temperaturePercent * parseInt(warmColor.substring(4, 7))
        );
        var g = Math.round(
            (1 - temperaturePercent) * parseInt(coolColor.substring(9, 12)) +
                temperaturePercent * parseInt(warmColor.substring(9, 12))
        );
        var b = Math.round(
            (1 - temperaturePercent) * parseInt(coolColor.substring(14, 17)) +
                temperaturePercent * parseInt(warmColor.substring(14, 17))
        );
        color = "rgb(" + r + ", " + g + ", " + b + ")";
    }

    return color;
}
