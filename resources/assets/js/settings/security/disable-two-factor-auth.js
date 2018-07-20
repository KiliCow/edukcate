module.exports = {
	props: ['user'],

    /**
     * The component's data.
     */
	data() {
		return {
			form: new EdukcateForm({})
		}
	},


	methods: {
		/**
		 * Disable two-factor authentication for the user.
		 */
		disable() {
			Edukcate.delete('/settings/two-factor-auth', this.form)
				.then(() => {
					Bus.$emit('updateUser');
				});
		}
	}
};
