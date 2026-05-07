<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List role assignments for a resource by external ID.
 *
 * Maps to the official WorkOS endpoint get /authorization/organizations/{organization_id}/resources/{resource_type_slug}/{external_id}/role_assignments.
 */
class WorkOSAuthorizationRoleAssignmentsListRoleAssignmentsForResourceByExternalId extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_role_assignments_list_role_assignments_for_resource_by_external_id';
    protected const DESCRIPTION = 'List role assignments for a resource by external ID

Official WorkOS endpoint: GET /authorization/organizations/{organization_id}/resources/{resource_type_slug}/{external_id}/role_assignments

List all role assignments granted on a resource, identified by its external ID. Each assignment includes the organization membership it was granted to.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `organization_id` from the official WorkOS API operation.',
  ),
  'resource_type_slug' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `resource_type_slug` from the official WorkOS API operation.',
  ),
  'external_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `external_id` from the official WorkOS API operation.',
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
    protected const PATH = '/authorization/organizations/{organization_id}/resources/{resource_type_slug}/{external_id}/role_assignments';
    protected const PATH_PARAMS = array (
  'organization_id' => 'organization_id',
  'resource_type_slug' => 'resource_type_slug',
  'external_id' => 'external_id',
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
