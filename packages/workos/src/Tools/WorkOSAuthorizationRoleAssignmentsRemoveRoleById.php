<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Remove a role assignment by ID.
 *
 * Maps to the official WorkOS endpoint delete /authorization/organization_memberships/{organization_membership_id}/role_assignments/{role_assignment_id}.
 */
class WorkOSAuthorizationRoleAssignmentsRemoveRoleById extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_role_assignments_remove_role_by_id';
    protected const DESCRIPTION = 'Remove a role assignment by ID

Official WorkOS endpoint: DELETE /authorization/organization_memberships/{organization_membership_id}/role_assignments/{role_assignment_id}

Remove a role assignment using its ID.';
    protected const PARAMETERS = array (
  'organization_membership_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `organization_membership_id` from the official WorkOS API operation.',
  ),
  'role_assignment_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `role_assignment_id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/authorization/organization_memberships/{organization_membership_id}/role_assignments/{role_assignment_id}';
    protected const PATH_PARAMS = array (
  'organization_membership_id' => 'organization_membership_id',
  'role_assignment_id' => 'role_assignment_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
