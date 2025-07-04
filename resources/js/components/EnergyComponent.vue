<template>
    <div>
        <h2>Energy Usage Data</h2>
        <ul>
            <li v-for="data in energyData" :key="data.id">
                Location: {{ data.location }}, Electricity Usage:
                {{ data.electricity_usage }} kWh, Water Usage:
                {{ data.water_usage }} m³, Gas Usage: {{ data.gas_usage }} m³,
                Recorded At: {{ data.recorded_at }}
            </li>
        </ul>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            energyData: [],
        };
    },
    created() {
        axios.get("//energy").then((response) => {
            this.energyData = response.data;
        });
    },
};
</script>
