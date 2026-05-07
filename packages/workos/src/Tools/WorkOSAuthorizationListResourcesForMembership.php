<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List resources for organization membership.
 *
 * Maps to the official WorkOS endpoint get /authorization/organization_memberships/{organization_membership_id}/resources.
 */
class WorkOSAuthorizationListResourcesForMembership extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_list_resources_for_membership';
    protected const DESCRIPTION = 'List resources for organization membership

Official WorkOS endpoint: GET /authorization/organization_memberships/{organization_membership_id}/resources

Returns all child resources of a parent resource where the organization membership has a specific permission. This is useful for resource discovery—answering "What projects can this user access in this workspace?" You must provide either `parent_resource_id` or both `parent_resource_external_id` and `parent_resource_type_slug` to identify the parent resource.';
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
  'permission_slug' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `permission_slug` from the official WorkOS API operation.',
  ),
  'parent_resource_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `parent_resource_id` from the official WorkOS API operation.',
  ),
  'parent_resource_type_slug' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `parent_resource_type_slug` from the official WorkOS API operation.',
  ),
  'parent_resource_external_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `parent_resource_external_id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/authorization/organization_memberships/{organization_membership_id}/resources';
    protected const PATH_PARAMS = array (
  'organization_membership_id' => 'organization_membership_id',
);
    protected const QUERY_PARAMS = array (
  'before' => 'before',
  'after' => 'after',
  'limit' => 'limit',
  'order' => 'order',
  'permission_slug' => 'permission_slug',
  'parent_resource_id' => 'parent_resource_id',
  'parent_resource_type_slug' => 'parent_resource_type_slug',
  'parent_resource_external_id' => 'parent_resource_external_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
