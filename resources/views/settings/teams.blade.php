<edukcate-teams :user="user" :teams="teams" inline-template>
    <div>
        <!-- Create Team -->
        @if (Edukcate::createsAdditionalTeams())
            @include('edukcate::settings.teams.create-team')
        @endif

        <!-- Pending Invitations -->
        @include('edukcate::settings.teams.pending-invitations')

        <!-- Current Teams -->
        <div v-if="user && teams.length > 0">
            @include('edukcate::settings.teams.current-teams')
        </div>
    </div>
</edukcate-teams>
