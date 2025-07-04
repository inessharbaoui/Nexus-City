<template>
    <div>
        <h2>Traffic Data</h2>
        <ul>
            <li v-for="data in trafficData" :key="data.id">
                {{ data.location }}: {{ data.vehicle_count }} vehicles,
                {{ data.average_speed }} km/h
            </li>
        </ul>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            trafficData: [],
        };
    },
    created() {
        axios.get("/api/traffic").then((response) => {
            this.trafficData = response.data;
        });
    },
};
</script>
