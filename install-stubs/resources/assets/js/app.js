
/*
 |--------------------------------------------------------------------------
 | Laravel Edukcate Bootstrap
 |--------------------------------------------------------------------------
 |
 | First, we will load all of the "core" dependencies for Edukcate which are
 | libraries such as Vue and jQuery. This also loads the Edukcate helpers
 | for things such as HTTP calls, forms, and form validation errors.
 |
 | Next, we'll create the root Vue application for Edukcate. This will start
 | the entire application and attach it to the DOM. Of course, you may
 | customize this script as you desire and load your own components.
 |
 */

require('edukcate-bootstrap');

require('./components/bootstrap');

var app = new Vue({
    mixins: [require('edukcate')]
});
