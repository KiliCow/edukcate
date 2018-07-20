/**
 * Initialize the Edukcate form extension points.
 */
Edukcate.forms = {
    register: {},
    updateContactInformation: {},
    updateTeamMember: {}
};

/**
 * Load the EdukcateForm helper class.
 */
require('./form');

/**
 * Define the EdukcateFormError collection class.
 */
require('./errors');

/**
 * Add additional HTTP / form helpers to the Edukcate object.
 */
$.extend(Edukcate, require('./http'));
