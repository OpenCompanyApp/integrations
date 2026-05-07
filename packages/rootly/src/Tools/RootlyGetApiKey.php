<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an API key.
 *
 * Maps to the official Rootly endpoint get /v1/api_keys/{id}.
 */
class RootlyGetApiKey extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_api_key';
    protected const DESCRIPTION = 'Retrieves an API key

Official Rootly endpoint: GET /v1/api_keys/{id}

Retrieves a specific API key by its UUID. Returns key metadata including name, kind, expiration, last usage timestamp, and the grace period status — the secret token is never included.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated list of relationships to include (role, on_call_role, created_by, groups)',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/api_keys/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
