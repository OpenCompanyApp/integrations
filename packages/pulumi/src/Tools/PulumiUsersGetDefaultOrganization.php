<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetDefaultOrganization.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/user/organizations/default.
 */
class PulumiUsersGetDefaultOrganization extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_users_get_default_organization';
    protected const DESCRIPTION = 'GetDefaultOrganization

Official Pulumi Cloud endpoint: GET /api/user/organizations/default

GetDefaultOrganization returns the default organization for the current user.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/api/user/organizations/default';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
