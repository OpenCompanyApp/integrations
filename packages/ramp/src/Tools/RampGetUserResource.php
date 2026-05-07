<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch a user.
 *
 * Maps to the official Ramp endpoint get /developer/v1/users/{user_id}.
 */
class RampGetUserResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_user_resource';
    protected const DESCRIPTION = 'Fetch a user

Official Ramp endpoint: GET /developer/v1/users/{user_id}';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `user_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/users/{user_id}';
    protected const PATH_PARAMS = array (
  'user_id' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
