<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update a user.
 *
 * Maps to the official Rootly endpoint put /v1/users/{id}.
 */
class RootlyUpdateUser extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_user';
    protected const DESCRIPTION = 'Update a user

Official Rootly endpoint: PUT /v1/users/{id}

Update a specific user by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/users/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
