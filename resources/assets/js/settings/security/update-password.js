module.exports = {
    /**
     * The component's data.
     */
    data() {
        return {
            form: new EdukcateForm({
                current_password: '',
                password: '',
                password_confirmation: ''
            })
        };
    },


    methods: {
        /**
         * Update the user's password.
         */
        update() {
            Edukcate.put('/settings/password', this.form);
        }
    }
};
