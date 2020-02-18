<template>
    <table>
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Last Synced</th>
            <th>Last Online</th>
            <th>Actions</th>
        </thead>
        <tbody>
            <tr v-for="item in items" v-bind:key="item.device_id">
                <td>{{item.device_id}}</td>
                <td>{{item.device_name}}</td>
                <td>{{item.last_sync}}</td>
                <td>N/A</td>
                <td><a href="#" class="btn btn-primary" v-on:click="action('reboot', item.device_id)">Reboot</a> <a href="#" class="btn btn-primary" v-on:click="action('shutdown', item.device_id)">Shutdown</a></td>
            </tr>
        </tbody>
    </table>
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