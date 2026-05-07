<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Remove a role assignment.
 *
 * Maps to the official WorkOS endpoint delete /authorization/organization_memberships/{organization_membership_id}/role_assignments.
 */
class WorkOSAuthorizationRoleAssignmentsRemoveRoleByCriteria extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_role_assignments_remove_role_by_criteria';
    protected const DESCRIPTION = 'Remove a role assignment

Official WorkOS endpoint: DELETE /authorization/organization_memberships/{organization_membership_id}/role_assignments

Remove a role assignment by role slug and resource.';
    protected const PARAMETERS = array (
  'organization_membership_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `organization_membership_id` from the official WorkOS API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/authorization/organization_memberships/{organization_membership_id}/role_assignments';
    protected const PATH_PARAMS = array (
  'organization_membership_id' => 'organization_membership_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
