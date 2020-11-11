<script>
export default {
    data() {
        return {
            getValue: 0
        }
    },
    methods: {
        action(type, deviceId, value) {
            this.$http.post('/api/device/' + deviceId + '/settings/' + type + '/update', 
                {value: value, _token: window.Laravel['csrfToken']
            });
        }
    }
}
</script>

<style scoped>
    table {
        width: 100%;
    }
    table td {
        padding: 15px;
    }
</style>