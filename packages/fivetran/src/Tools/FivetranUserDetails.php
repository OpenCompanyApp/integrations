<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Retrieve a User Details.
 *
 * Maps to the official Fivetran endpoint get /v1/users/{userId}.
 */
class FivetranUserDetails extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_user_details';
    protected const DESCRIPTION = 'Retrieve a User Details

Official Fivetran endpoint: GET /v1/users/{userId}

Returns a user object if a valid identifier was provided.';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userId` from the official Fivetran API operation. The unique identifier for the user within the account.',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/users/{userId}';
    protected const PATH_PARAMS = array (
  'userId' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
