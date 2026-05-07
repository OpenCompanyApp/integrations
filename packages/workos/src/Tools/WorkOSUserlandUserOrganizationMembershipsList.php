<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List organization memberships.
 *
 * Maps to the official WorkOS endpoint get /user_management/organization_memberships.
 */
class WorkOSUserlandUserOrganizationMembershipsList extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_user_organization_memberships_list';
    protected const DESCRIPTION = 'List organization memberships

Official WorkOS endpoint: GET /user_management/organization_memberships

Get a list of all organization memberships matching the criteria specified. At least one of `user_id` or `organization_id` must be provided. By default only active memberships are returned. Use the `statuses` parameter to filter by other statuses.';
    protected const PARAMETERS = array (
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
  'organization_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `organization_id` from the official WorkOS API operation.',
  ),
  'statuses' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `statuses` from the official WorkOS API operation.',
  ),
  'user_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `user_id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/user_management/organization_memberships';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'before' => 'before',
  'after' => 'after',
  'limit' => 'limit',
  'order' => 'order',
  'organization_id' => 'organization_id',
  'statuses' => 'statuses',
  'user_id' => 'user_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
