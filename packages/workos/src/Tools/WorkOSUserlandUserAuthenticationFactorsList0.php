<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List authentication factors.
 *
 * Maps to the official WorkOS endpoint get /user_management/users/{userlandUserId}/auth_factors.
 */
class WorkOSUserlandUserAuthenticationFactorsList0 extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_user_authentication_factors_list_0';
    protected const DESCRIPTION = 'List authentication factors

Official WorkOS endpoint: GET /user_management/users/{userlandUserId}/auth_factors

Lists the [authentication factors](/reference/authkit/mfa/authentication-factor) for a user.';
    protected const PARAMETERS = array (
  'userland_user_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userlandUserId` from the official WorkOS API operation.',
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
    protected const PATH = '/user_management/users/{userlandUserId}/auth_factors';
    protected const PATH_PARAMS = array (
  'userlandUserId' => 'userland_user_id',
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
