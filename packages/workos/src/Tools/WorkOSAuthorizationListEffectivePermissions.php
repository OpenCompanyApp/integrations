<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List effective permissions for an organization membership on a resource.
 *
 * Maps to the official WorkOS endpoint get /authorization/organization_memberships/{organization_membership_id}/resources/{resource_id}/permissions.
 */
class WorkOSAuthorizationListEffectivePermissions extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_list_effective_permissions';
    protected const DESCRIPTION = 'List effective permissions for an organization membership on a resource

Official WorkOS endpoint: GET /authorization/organization_memberships/{organization_membership_id}/resources/{resource_id}/permissions

Returns all permissions the organization membership effectively has on a resource, including permissions inherited through roles assigned to ancestor resources.';
    protected const PARAMETERS = array (
  'organization_membership_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `organization_membership_id` from the official WorkOS API operation.',
  ),
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
    protected const PATH = '/authorization/organization_memberships/{organization_membership_id}/resources/{resource_id}/permissions';
    protected const PATH_PARAMS = array (
  'organization_membership_id' => 'organization_membership_id',
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
