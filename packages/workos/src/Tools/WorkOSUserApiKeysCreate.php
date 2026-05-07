<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Create an API key for a user.
 *
 * Maps to the official WorkOS endpoint post /user_management/users/{userId}/api_keys.
 */
class WorkOSUserApiKeysCreate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_user_api_keys_create';
    protected const DESCRIPTION = 'Create an API key for a user

Official WorkOS endpoint: POST /user_management/users/{userId}/api_keys

Create a new API key owned by a user. The user must have an active membership in the specified organization.';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userId` from the official WorkOS API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user_management/users/{userId}/api_keys';
    protected const PATH_PARAMS = array (
  'userId' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
