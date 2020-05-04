<script>
import {bus} from '../app';


export default {
    name: 'navigation',
	data() {
		return {
            showNavigation: false,
		};
	},
	methods: {
        toggle: function() {
            this.showNavigation = !this.showNavigation;
        }
	}
};
</script>