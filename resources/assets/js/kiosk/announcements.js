var announcementsCreateForm = function () {
    return {
        body: '',
        action_text: '',
        action_url: ''
    };
};

module.exports = {
    /**
     * The component's data.
     */
    data() {
        return {
            announcements: [],
            updatingAnnouncement: null,
            deletingAnnouncement: null,

            createForm: new EdukcateForm(announcementsCreateForm()),
            updateForm: new EdukcateForm(announcementsCreateForm()),

            deleteForm: new EdukcateForm({})
        };
    },

    
    /**
     * The component has been created by Vue.
     */
    created() {
        var self = this;

        Bus.$on('edukcateHashChanged', function (hash, parameters) {
            if (hash == 'announcements' && self.announcements.length === 0) {
                self.getAnnouncements();
            }
        });
    },


    methods: {
        /**
         * Get all of the announcements.
         */
        getAnnouncements() {
            axios.get('/edukcate/kiosk/announcements')
                .then(response => {
                    this.announcements = response.data;
                });
        },


        /**
         * Create a new announcement.
         */
        create() {
            Edukcate.post('/edukcate/kiosk/announcements', this.createForm)
                .then(() => {
                    this.createForm = new EdukcateForm(announcementsCreateForm());

                    this.getAnnouncements();
                });
        },


        /**
         * Edit the given announcement.
         */
        editAnnouncement(announcement) {
            this.updatingAnnouncement = announcement;

            this.updateForm.icon = announcement.icon;
            this.updateForm.body = announcement.body;
            this.updateForm.action_text = announcement.action_text;
            this.updateForm.action_url = announcement.action_url;

            $('#modal-update-announcement').modal('show');
        },


        /**
         * Update the specified announcement.
         */
        update() {
            Edukcate.put('/edukcate/kiosk/announcements/' + this.updatingAnnouncement.id, this.updateForm)
                .then(() => {
                    this.getAnnouncements();

                    $('#modal-update-announcement').modal('hide');
                });
        },


        /**
         * Show the approval dialog for deleting an announcement.
         */
        approveAnnouncementDelete(announcement) {
            this.deletingAnnouncement = announcement;

            $('#modal-delete-announcement').modal('show');
        },


        /**
         * Delete the specified announcement.
         */
        deleteAnnouncement() {
            Edukcate.delete('/edukcate/kiosk/announcements/' + this.deletingAnnouncement.id, this.deleteForm)
                .then(() => {
                    this.getAnnouncements();

                    $('#modal-delete-announcement').modal('hide');
                });
        }
    }
};
