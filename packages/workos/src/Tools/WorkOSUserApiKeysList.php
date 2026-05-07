<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List API keys for a user.
 *
 * Maps to the official WorkOS endpoint get /user_management/users/{userId}/api_keys.
 */
class WorkOSUserApiKeysList extends AbstractWorkOSTool
{
    protected const NAME = 'workos_user_api_keys_list';
    protected const DESCRIPTION = 'List API keys for a user

Official WorkOS endpoint: GET /user_management/users/{userId}/api_keys

Get a list of API keys owned by a specific user.';
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
  'organization_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `organization_id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/user_management/users/{userId}/api_keys';
    protected const PATH_PARAMS = array (
  'userId' => 'user_id',
);
    protected const QUERY_PARAMS = array (
  'before' => 'before',
  'after' => 'after',
  'limit' => 'limit',
  'order' => 'order',
  'organization_id' => 'organization_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
