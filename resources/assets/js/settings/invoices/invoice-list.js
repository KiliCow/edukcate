module.exports = {
    props: ['user', 'team', 'invoices', 'billableType'],


    methods: {
        /**
         * Get the URL for downloading a given invoice.
         */
        downloadUrlFor(invoice) {
            return this.billingUser
                        ? `/settings/invoice/${invoice.id}`
                        : `/settings/${Edukcate.teamsPrefix}/${this.team.id}/invoice/${invoice.id}`;
        }
    }
};
