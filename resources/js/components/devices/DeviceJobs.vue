<template>
    <div class="table-responsive-md">
        <table class="table">
            <thead class="thead">
                <th>ID</th>
                <th>Device Name</th>
                <th>Key</th>
                <th>Value</th>
                <th>Status</th>
                <th>Date Created</th>
            </thead>
            <tbody>
                <tr v-for="item in items" v-bind:key="item.device_job_id">
                    <td>{{item.device_job_id}}</td>
                    <td>{{item.device_name}}</td>
                    <td>{{item.key}}</td>
                    <td>{{item.value}}</td>
                    <td>{{item.status}}</td>
                    <td>{{item.created_at}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
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
			this.$http.get('/api/device/jobs')
			.then(function(response) {
                self.items = response.data;
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