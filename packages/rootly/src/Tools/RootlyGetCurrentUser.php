<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Get current user.
 *
 * Maps to the official Rootly endpoint get /v1/users/me.
 */
class RootlyGetCurrentUser extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_current_user';
    protected const DESCRIPTION = 'Get current user

Official Rootly endpoint: GET /v1/users/me

Get current user';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/users/me';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
