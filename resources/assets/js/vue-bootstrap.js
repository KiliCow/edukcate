/*
 * Load Vue, the JavaScript framework used by Edukcate.
 */
if (window.Vue === undefined) {
    window.Vue = require('vue');

    window.Bus = new Vue();
}

/**
 * Load Vue Global Mixin.
 */
Vue.mixin(require('./mixin'));

/**
 * Define the Vue filters.
 */
require('./filters');

/**
 * Load the Edukcate form utilities.
 */
require('./forms/bootstrap');
