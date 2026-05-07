<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Revoke an API key.
 *
 * Maps to the official Rootly endpoint delete /v1/api_keys/{id}.
 */
class RootlyDeleteApiKey extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_api_key';
    protected const DESCRIPTION = 'Revoke an API key

Official Rootly endpoint: DELETE /v1/api_keys/{id}

Revoke an API key. The key is immediately invalidated and can no longer be used for authentication. This action cannot be undone.

For `team` and `organization` keys, the associated service account is also deleted. Any active sessions using this key will fail on the next request.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/api_keys/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
