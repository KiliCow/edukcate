<edukcate-team-membership :user="user" :team="team" :billable-type="billableType" inline-template>
    <div>
        @if (Auth::user()->ownsTeam($team))
            <!-- Send Invitation -->
            <div v-if="user && team">
                @include('edukcate::settings.teams.send-invitation')
            </div>

            <!-- Pending Invitations -->
            <div v-if="invitations && invitations.length > 0">
                @include('edukcate::settings.teams.mailed-invitations')
            </div>
        @endif

        <!-- Team Members -->
        <div v-if="user && team">
            @include('edukcate::settings.teams.team-members')
        </div>
    </div>
</edukcate-team-membership>
