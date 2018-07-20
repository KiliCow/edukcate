module.exports = {
    props: ['user', 'team', 'billableType'],

    /**
     * The component's data.
     */
    data() {
        return {
            form: new EdukcateForm({
                coupon: ''
            })
        };
    },


    methods: {
        /**
         * Redeem the given coupon code.
         */
        redeem() {
            Edukcate.post(this.urlForRedemption, this.form)
                .then(() => {
                    this.form.coupon = '';

                    this.$parent.$emit('updateDiscount');
                });
        }
    },


    computed: {
        /**
         * Get the URL for redeeming a coupon.
         */
        urlForRedemption() {
            return this.billingUser
                            ? '/settings/payment-method/coupon'
                            : `/settings/${Edukcate.teamsPrefix}/${this.team.id}/payment-method/coupon`;
        }
    }
};
