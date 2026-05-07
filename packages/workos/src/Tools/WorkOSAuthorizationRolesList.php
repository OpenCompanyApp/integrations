<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List environment roles.
 *
 * Maps to the official WorkOS endpoint get /authorization/roles.
 */
class WorkOSAuthorizationRolesList extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_roles_list';
    protected const DESCRIPTION = 'List environment roles

Official WorkOS endpoint: GET /authorization/roles

List all environment roles in priority order.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/authorization/roles';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
