@if (Edukcate::billsUsingStripe())
    @include('edukcate::settings.subscription.subscribe-stripe')
@else
    @include('edukcate::settings.subscription.subscribe-braintree')
@endif
