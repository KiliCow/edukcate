<!-- Teams -->
<h6 class="dropdown-header">{{ __('teams.teams')}}</h6>

<!-- Create Team -->
@if (Edukcate::createsAdditionalTeams())
    <a class="dropdown-item" href="/settings#/{{Edukcate::teamsPrefix()}}">
        <i class="fa fa-fw text-left fa-btn fa-plus-circle"></i> {{__('teams.create_team')}}
    </a>
@endif

<!-- Switch Current Team -->
@if (Edukcate::showsTeamSwitcher())
    <a class="dropdown-item" v-for="team in teams" :href="'/settings/{{ Edukcate::teamsPrefix() }}/'+ team.id +'/switch'">
        <span v-if="user.current_team_id == team.id">
            <i class="fa fa-fw text-left fa-btn fa-check text-success"></i> @{{ team.name }}
        </span>

        <span v-else>
            <img :src="team.photo_url" class="edukcate-profile-photo-xs"><i class="fa fa-btn"></i> @{{ team.name }}
        </span>
    </a>
@endif

<div class="dropdown-divider"></div>
