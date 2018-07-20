<edukcate-subscription :user="user" :team="team" :billable-type="billableType" inline-template>
    <div>
        <div v-if="plans.length > 0">
            <!-- Trial Expiration Notice -->
            @include('edukcate::settings.subscription.trial-expiration-notice')

            <!-- New Subscription -->
            <div v-if="needsSubscription">
                @include('edukcate::settings.subscription.subscribe')
            </div>

            <!-- Update Subscription -->
            <div v-if="subscriptionIsActive">
                @include('edukcate::settings.subscription.update-subscription')
            </div>

            <!-- Resume Subscription -->
            <div v-if="subscriptionIsOnGracePeriod">
                @include('edukcate::settings.subscription.resume-subscription')
            </div>

            <!-- Cancel Subscription -->
            <div v-if="subscriptionIsActive">
                @include('edukcate::settings.subscription.cancel-subscription')
            </div>
        </div>

        <!-- Plan Features Modal -->
        @include('edukcate::modals.plan-details')
    </div>
</edukcate-subscription>
