<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List organization memberships for resource.
 *
 * Maps to the official WorkOS endpoint get /authorization/resources/{resource_id}/organization_memberships.
 */
class WorkOSAuthorizationResourcesListOrganizationMembershipsForResource extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_resources_list_organization_memberships_for_resource';
    protected const DESCRIPTION = 'List organization memberships for resource

Official WorkOS endpoint: GET /authorization/resources/{resource_id}/organization_memberships

Returns all organization memberships that have a specific permission on a resource instance. This is useful for answering "Who can access this resource?".';
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
  'permission_slug' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `permission_slug` from the official WorkOS API operation.',
  ),
  'assignment' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `assignment` from the official WorkOS API operation.',
    'enum' =>
    array (
      0 => 'direct',
      1 => 'indirect',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/authorization/resources/{resource_id}/organization_memberships';
    protected const PATH_PARAMS = array (
  'resource_id' => 'resource_id',
);
    protected const QUERY_PARAMS = array (
  'before' => 'before',
  'after' => 'after',
  'limit' => 'limit',
  'order' => 'order',
  'permission_slug' => 'permission_slug',
  'assignment' => 'assignment',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
