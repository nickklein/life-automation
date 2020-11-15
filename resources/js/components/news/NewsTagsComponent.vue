<template>
  <div>
    <vue-tags-input
      v-model="tag"
      :tags="tags"
      @before-adding-tag="addTag"
      @before-deleting-tag="removeTag"
    />
  </div>
</template>


<script>
import VueTagsInput from '@johmun/vue-tags-input';

export default {
	name: 'news-tags',
	components: {
		VueTagsInput
	},
	data() {
		return {
			tag: '',
			tags: [],
		};
	},
	methods: {
		addTag(obj) {
			this.$http.post('/api/settings/tags/store', {tag_name: obj.tag.text,_token: window.Laravel['csrfToken']});
			obj.addTag();
		},
		removeTag(obj) {
			this.$http.post('/api/settings/tags/delete', {tag_name: obj.tag.text,_token: window.Laravel['csrfToken']});
			obj.deleteTag();
		}
	},
	created: function() {
		this.$http.get('/api/settings/tags')
		.then(function(response) {
			this.tags = response.data.data;
		});
	}
};
</script>