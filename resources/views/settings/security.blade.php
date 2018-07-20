<edukcate-security :user="user" inline-template>
	<div>
	    <!-- Update Password -->
	    @include('edukcate::settings.security.update-password')

	    <!-- Two-Factor Authentication -->
	    @if (Edukcate::usesTwoFactorAuth())
	    	<div v-if="user && ! user.uses_two_factor_auth">
	    		@include('edukcate::settings.security.enable-two-factor-auth')
	    	</div>

	    	<div v-if="user && user.uses_two_factor_auth">
	    		@include('edukcate::settings.security.disable-two-factor-auth')
	    	</div>

			<!-- Two-Factor Reset Code Modal -->
	    	@include('edukcate::settings.security.modals.two-factor-reset-code')
	    @endif
    </div>
</edukcate-security>
