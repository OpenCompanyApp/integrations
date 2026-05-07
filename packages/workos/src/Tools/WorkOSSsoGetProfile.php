<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get a User Profile.
 *
 * Maps to the official WorkOS endpoint get /sso/profile.
 */
class WorkOSSsoGetProfile extends AbstractWorkOSTool
{
    protected const NAME = 'workos_sso_get_profile';
    protected const DESCRIPTION = 'Get a User Profile

Official WorkOS endpoint: GET /sso/profile

Exchange an access token for a user\'s [Profile](/reference/sso/profile). Because this profile is returned in the [Get a Profile and Token endpoint](/reference/sso/profile/get-profile-and-token) your application usually does not need to call this endpoint. It is available for any authentication flows that require an additional endpoint to retrieve a user\'s profile.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/sso/profile';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
