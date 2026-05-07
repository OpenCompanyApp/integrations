<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List effective permissions for an organization membership on a resource by external ID.
 *
 * Maps to the official WorkOS endpoint get /authorization/organization_memberships/{organization_membership_id}/resources/{resource_type_slug}/{external_id}/permissions.
 */
class WorkOSAuthorizationListEffectivePermissionsByExternalId extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_list_effective_permissions_by_external_id';
    protected const DESCRIPTION = 'List effective permissions for an organization membership on a resource by external ID

Official WorkOS endpoint: GET /authorization/organization_memberships/{organization_membership_id}/resources/{resource_type_slug}/{external_id}/permissions

Returns all permissions the organization membership effectively has on a resource identified by its external ID, including permissions inherited through roles assigned to ancestor resources.';
    protected const PARAMETERS = array (
  'organization_membership_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `organization_membership_id` from the official WorkOS API operation.',
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
    protected const PATH = '/authorization/organization_memberships/{organization_membership_id}/resources/{resource_type_slug}/{external_id}/permissions';
    protected const PATH_PARAMS = array (
  'organization_membership_id' => 'organization_membership_id',
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
