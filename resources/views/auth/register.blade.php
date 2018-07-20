@if (Edukcate::billsUsingStripe())
    @include('edukcate::auth.register-stripe')
@else
    @include('edukcate::auth.register-braintree')
@endif
