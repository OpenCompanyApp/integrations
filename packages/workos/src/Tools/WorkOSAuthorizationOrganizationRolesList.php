<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List custom roles.
 *
 * Maps to the official WorkOS endpoint get /authorization/organizations/{organizationId}/roles.
 */
class WorkOSAuthorizationOrganizationRolesList extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_organization_roles_list';
    protected const DESCRIPTION = 'List custom roles

Official WorkOS endpoint: GET /authorization/organizations/{organizationId}/roles

Get a list of all roles that apply to an organization. This includes both environment roles and custom roles, returned in priority order.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `organizationId` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/authorization/organizations/{organizationId}/roles';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
