<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetUserHasVerifiedEmail.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/user/verified-email.
 */
class PulumiUsersGetUserHasVerifiedEmail extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_users_get_user_has_verified_email';
    protected const DESCRIPTION = 'GetUserHasVerifiedEmail

Official Pulumi Cloud endpoint: GET /api/user/verified-email

GetUserHasVerifiedEmail returns a success response if the user has a verified email, 404 not found if they are not verified';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/api/user/verified-email';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
