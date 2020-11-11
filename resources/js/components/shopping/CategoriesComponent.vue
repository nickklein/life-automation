<script>
export default {
    data() {
        return {
            items: [],
            sortKey: ''
        }
    },
    methods: {
        changeSelect(event) {
            var selectValue = event.target.value;
            var categoryId = event.currentTarget.getAttribute('category_id');

            this.$http.post('/api/shopping/category/update', {
                categoryId: categoryId,
                changeValue: selectValue,
                _token: window.Laravel['csrfToken']
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