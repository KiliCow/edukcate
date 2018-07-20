<edukcate-team-profile :user="user" :team="team" inline-template>
    <div>
        <div v-if="user && team">
            <!-- Update Team Photo -->
            @include('edukcate::settings.teams.update-team-photo')

            <!-- Update Team Name -->
            @include('edukcate::settings.teams.update-team-name')
        </div>
    </div>
</edukcate-team-profile>
