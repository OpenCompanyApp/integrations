<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetCurrentUser.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/user.
 */
class PulumiUsersGetCurrentUser extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_users_get_current_user';
    protected const DESCRIPTION = 'GetCurrentUser

Official Pulumi Cloud endpoint: GET /api/user

Returns the authenticated user\'s profile information, including login name, display name, email, avatar URL, and organization memberships.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/api/user';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
