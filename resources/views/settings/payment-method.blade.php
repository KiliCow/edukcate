@if (Edukcate::billsUsingStripe())
    @include('edukcate::settings.payment-method-stripe')
@else
    @include('edukcate::settings.payment-method-braintree')
@endif
