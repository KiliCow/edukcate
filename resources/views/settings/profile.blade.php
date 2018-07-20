<edukcate-profile :user="user" inline-template>
    <div>
        <!-- Update Profile Photo -->
        @include('edukcate::settings.profile.update-profile-photo')

        <!-- Update Contact Information -->
        @include('edukcate::settings.profile.update-contact-information')
    </div>
</edukcate-profile>
