<script>
export default {
	name: 'news-list',
	data() {
		return {
			sources: [],
		}
	},
	methods: {
        favourite(favId, status) {
            console.log(favId, status);
            this.$http.post('/api/news/favourites/update', { 
                source_link_id: favId, 
                status: status, 
                _token: window.Laravel['csrfToken']
            });
        }
	}
};
</script>
