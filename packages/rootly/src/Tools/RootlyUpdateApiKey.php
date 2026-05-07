<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update an API key.
 *
 * Maps to the official Rootly endpoint put /v1/api_keys/{id}.
 */
class RootlyUpdateApiKey extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_api_key';
    protected const DESCRIPTION = 'Update an API key

Official Rootly endpoint: PUT /v1/api_keys/{id}

Update an API key\'s mutable attributes: `name`, `description`, and `expires_at`.

The key\'s `kind`, `role_id`, `on_call_role_id`, and token cannot be changed after creation. To issue a new token, use the rotate endpoint. To change the role or kind, revoke the key and create a new one.

The new `expires_at` must be in the future and within 5 years.';
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
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/api_keys/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
