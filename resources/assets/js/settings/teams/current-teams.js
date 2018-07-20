module.exports = {
    props: ['user', 'teams'],


    /**
     * The component's data.
     */
    data() {
        return {
            leavingTeam: null,
            deletingTeam: null,

            leaveTeamForm: new EdukcateForm({}),
            deleteTeamForm: new EdukcateForm({})
        };
    },


    /**
     * Prepare the component.
     */
    mounted() {
        $('[data-toggle="tooltip"]').tooltip();
    },


    computed: {
        /**
         * Get the URL for leaving a team.
         */
        urlForLeaving() {
            return `/settings/${Edukcate.teamsPrefix}/${this.leavingTeam.id}/members/${this.user.id}`;
        }
    },


    methods: {
        /**
         * Approve leaving the given team.
         */
        approveLeavingTeam(team) {
            this.leavingTeam = team;

            $('#modal-leave-team').modal('show');
        },


        /**
         * Leave the given team.
         */
        leaveTeam() {
            Edukcate.delete(this.urlForLeaving, this.leaveTeamForm)
                .then(() => {
                    Bus.$emit('updateUser');
                    Bus.$emit('updateTeams');

                    $('#modal-leave-team').modal('hide');
                });
        },


        /**
         * Approve the deletion of the given team.
         */
        approveTeamDelete(team) {
            this.deletingTeam = team;

            $('#modal-delete-team').modal('show');
        },


        /**
         * Delete the given team.
         */
        deleteTeam() {
            Edukcate.delete(`/settings/${Edukcate.teamsPrefix}/${this.deletingTeam.id}`, this.deleteTeamForm)
                .then(() => {
                    Bus.$emit('updateUser');
                    Bus.$emit('updateTeams');

                    $('#modal-delete-team').modal('hide');
                });
        }
    }
};
