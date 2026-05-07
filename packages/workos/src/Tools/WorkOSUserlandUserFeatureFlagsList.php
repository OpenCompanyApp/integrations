<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List enabled feature flags for a user.
 *
 * Maps to the official WorkOS endpoint get /user_management/users/{userId}/feature-flags.
 */
class WorkOSUserlandUserFeatureFlagsList extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_user_feature_flags_list';
    protected const DESCRIPTION = 'List enabled feature flags for a user

Official WorkOS endpoint: GET /user_management/users/{userId}/feature-flags

Get a list of all enabled feature flags for the provided user. This includes feature flags enabled specifically for the user as well as any organizations that the user is a member of.';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userId` from the official WorkOS API operation.',
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
    protected const PATH = '/user_management/users/{userId}/feature-flags';
    protected const PATH_PARAMS = array (
  'userId' => 'user_id',
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
