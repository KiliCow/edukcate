module.exports = {
    props: ['user', 'team', 'billableType'],

    /**
     * The component's data.
     */
    data() {
        return {
            form: new EdukcateForm({
                information: ''
            })
        };
    },


    /**
     * Prepare the component.
     */
    mounted() {
        this.form.information = this.billable.extra_billing_information;
    },



    methods: {
        /**
         * Update the extra billing information.
         */
        update() {
            Edukcate.put(this.urlForUpdate, this.form);
        }
    },


    computed: {
        /**
         * Get the URL for the extra billing information method update.
         */
        urlForUpdate() {
            return this.billingUser
                            ? '/settings/extra-billing-information'
                            : `/settings/${Edukcate.teamsPrefix}/${this.team.id}/extra-billing-information`;
        }
    }
};
