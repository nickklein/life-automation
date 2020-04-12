<script>
export default {
    data() {
        return {
            items: []
        }
    },
    methods: {
        fetch() {
            var self = this;
			this.$http.get('/api/devices')
			.then(function(response) {
                self.items = response.data;
			});
        },
        action(type, id) {
            this.$http.post('/api/device/' + id + '/jobs/create', 
                {type: type,_token: window.Laravel['csrfToken']
            });
        }
    },
    mounted() {
        this.fetch();
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