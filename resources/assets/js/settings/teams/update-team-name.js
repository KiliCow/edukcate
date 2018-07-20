module.exports = {
    props: ['user', 'team'],

    /**
     * The component's data.
     */
    data() {
        return {
            form: new EdukcateForm({
                name: ''
            })
        };
    },


    /**
     * Prepare the component.
     */
    mounted() {
        this.form.name = this.team.name;
    },


    methods: {
        /**
         * Update the team name.
         */
        update() {
            Edukcate.put(`/settings/${Edukcate.teamsPrefix}/${this.team.id}/name`, this.form)
                .then(() => {
                    Bus.$emit('updateTeam');
                    Bus.$emit('updateTeams');
                });
        }
    }
};
