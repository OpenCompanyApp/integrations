<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get the currently authenticated user.
 *
 * Maps to the official FireHydrant endpoint get /v1/current_user.
 */
class FireHydrantGetCurrentUser extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_current_user';
    protected const DESCRIPTION = 'Get the currently authenticated user

Official FireHydrant endpoint: GET /v1/current_user

Retrieve the current user';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/current_user';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
