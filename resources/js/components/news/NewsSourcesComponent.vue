<template>
	<div>
		<span v-for="(source, index) in sources" :key="index" >
			<input type="checkbox" name="sources" v-on:change="checkBox(index)" v-model="source.active" :id="'id_'+ index +'_a'" :checked="source.active" :key="source.source_id" /><label :for="'id_'+index+'_a'">{{source.source_name}}</label>
		</span>
	</div>
</template>

<script>
export default {
	name: 'news-sources',
	data() {
		return {
			sources: [],
		}
	},
	methods: {
		checkBox(index) {
			this.$http.post('/api/settings/sources/update', { source_id: this.sources[index].source_id, active: this.sources[index].active, _token: window.Laravel['csrfToken']});
		}

	},
	created: function() {
		this.$http.get('/api/settings/sources')
		.then(function(response) {
			this.sources = response.data.data;
		});
	}
};
</script>
