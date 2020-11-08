<template>
    <div class ="card">
        
        <h5>{{ current.city }}</h5>
        <div class="updated">{{ current.updated }}</div>
        <div class="current">
            <div class="icon"><img :src="'http://openweathermap.org/img/wn/'+current.icon+'@2x.png'"></div>
            <div class="temperature">{{ current.temperature }}</div>
        </div>

        <div class="forecast">
            <div class="column" v-for="forecast in forecasts">
                <div class="day">{{ forecast["day"] }}</div>
                <div class="time">{{ forecast["time"] }}</div>
                <div class="status">{{ forecast["description"] }}</div>
                <div class="temperature">{{ forecast["temp"] }}</div>
                <div class="icon"><img :src="'http://openweathermap.org/img/wn/'+forecast['icon']+'@2x.png'" /></div>
                <div class="cloudiness">{{ forecast["cloudiness"] }}</div>
                <div class="rain">{{ forecast["rain"] }}</div>
                <div class="rain3h">{{ forecast["rain3h"] }}</div>
                <div class="snow">{{ forecast["snow"] }}</div>
                <div class="snow3h">{{ forecast["snow3h"] }}</div>
            </div>
        </div>

    </div>
</template>
<script>
export default {
    data() {
        return {
            current: {
                city: '',
                updated: '',
                icon: '',
                temperature: '',
            },
            forecasts: [],
        }
    },
    methods: {
        fetch() {
            var self = this;
			this.$http.get('/api/weather/dashboard')
			.then(function(response) {
                self.currentList(response.data.current)
                self.forecastList(response.data.forecast);
			});
        },
        currentList(data) {
            console.log(data[0]);
            this.current.city = data[0].city_name;
            this.current.updated = data[0].timestamp;
            this.current.icon = data[0].icon;
            this.current.temperature = data[0].temp;
        },
        forecastList(data) {
            this.forecasts = data;
        }

    },
    mounted() {
        this.fetch();
    }
}
</script>