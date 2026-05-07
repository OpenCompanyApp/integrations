<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Assign a role.
 *
 * Maps to the official WorkOS endpoint post /authorization/organization_memberships/{organization_membership_id}/role_assignments.
 */
class WorkOSAuthorizationRoleAssignmentsAssignRole extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_role_assignments_assign_role';
    protected const DESCRIPTION = 'Assign a role

Official WorkOS endpoint: POST /authorization/organization_memberships/{organization_membership_id}/role_assignments

Assign a role to an organization membership on a specific resource.';
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
    protected const METHOD = 'post';
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
