<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List role assignments.
 *
 * Maps to the official WorkOS endpoint get /authorization/organization_memberships/{organization_membership_id}/role_assignments.
 */
class WorkOSAuthorizationRoleAssignmentsListRoleAssignments extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_role_assignments_list_role_assignments';
    protected const DESCRIPTION = 'List role assignments

Official WorkOS endpoint: GET /authorization/organization_memberships/{organization_membership_id}/role_assignments

List all role assignments for an organization membership. This returns all roles that have been assigned to the user on resources, including organization-level and sub-resource roles.';
    protected const PARAMETERS = array (
  'organization_membership_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `organization_membership_id` from the official WorkOS API operation.',
  ),
  'before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `before` from the official WorkOS API operation.',
  ),
  'after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `after` from the official WorkOS API operation.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official WorkOS API operation.',
  ),
  'order' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `order` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/authorization/organization_memberships/{organization_membership_id}/role_assignments';
    protected const PATH_PARAMS = array (
  'organization_membership_id' => 'organization_membership_id',
);
    protected const QUERY_PARAMS = array (
  'before' => 'before',
  'after' => 'after',
  'limit' => 'limit',
  'order' => 'order',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
