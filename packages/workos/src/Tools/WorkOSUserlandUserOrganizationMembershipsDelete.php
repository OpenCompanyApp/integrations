<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Delete an organization membership.
 *
 * Maps to the official WorkOS endpoint delete /user_management/organization_memberships/{id}.
 */
class WorkOSUserlandUserOrganizationMembershipsDelete extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_user_organization_memberships_delete';
    protected const DESCRIPTION = 'Delete an organization membership

Official WorkOS endpoint: DELETE /user_management/organization_memberships/{id}

Permanently deletes an existing organization membership. It cannot be undone.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/user_management/organization_memberships/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
