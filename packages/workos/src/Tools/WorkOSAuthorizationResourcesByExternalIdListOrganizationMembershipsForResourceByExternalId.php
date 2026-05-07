<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List memberships for a resource by external ID.
 *
 * Maps to the official WorkOS endpoint get /authorization/organizations/{organization_id}/resources/{resource_type_slug}/{external_id}/organization_memberships.
 */
class WorkOSAuthorizationResourcesByExternalIdListOrganizationMembershipsForResourceByExternalId extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_resources_by_external_id_list_organization_memberships_for_resource_by_external_id';
    protected const DESCRIPTION = 'List memberships for a resource by external ID

Official WorkOS endpoint: GET /authorization/organizations/{organization_id}/resources/{resource_type_slug}/{external_id}/organization_memberships

Returns all organization memberships that have a specific permission on a resource, using the resource\'s external ID. This is useful for answering "Who can access this resource?" when you only have the external ID.';
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
    protected const PATH = '/authorization/organizations/{organization_id}/resources/{resource_type_slug}/{external_id}/organization_memberships';
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
  'permission_slug' => 'permission_slug',
  'assignment' => 'assignment',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
