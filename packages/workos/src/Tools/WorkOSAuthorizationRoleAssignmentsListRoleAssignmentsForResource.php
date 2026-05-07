<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List role assignments for a resource.
 *
 * Maps to the official WorkOS endpoint get /authorization/resources/{resource_id}/role_assignments.
 */
class WorkOSAuthorizationRoleAssignmentsListRoleAssignmentsForResource extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_role_assignments_list_role_assignments_for_resource';
    protected const DESCRIPTION = 'List role assignments for a resource

Official WorkOS endpoint: GET /authorization/resources/{resource_id}/role_assignments

List all role assignments granted on a specific resource instance. Each assignment includes the organization membership it was granted to.';
    protected const PARAMETERS = array (
  'resource_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `resource_id` from the official WorkOS API operation.',
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
    protected const PATH = '/authorization/resources/{resource_id}/role_assignments';
    protected const PATH_PARAMS = array (
  'resource_id' => 'resource_id',
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
