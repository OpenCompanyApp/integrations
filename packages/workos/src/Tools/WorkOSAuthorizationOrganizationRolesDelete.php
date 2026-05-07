<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Delete a custom role.
 *
 * Maps to the official WorkOS endpoint delete /authorization/organizations/{organizationId}/roles/{slug}.
 */
class WorkOSAuthorizationOrganizationRolesDelete extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_organization_roles_delete';
    protected const DESCRIPTION = 'Delete a custom role

Official WorkOS endpoint: DELETE /authorization/organizations/{organizationId}/roles/{slug}

Delete an existing custom role.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `organizationId` from the official WorkOS API operation.',
  ),
  'slug' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `slug` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/authorization/organizations/{organizationId}/roles/{slug}';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
  'slug' => 'slug',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
