<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Create API Keys V1.
 *
 * Maps to the official incident.io endpoint post /v1/api_keys.
 */
class IncidentIoApiKeysV1Create extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_api_keys_v1_create';
    protected const DESCRIPTION = 'Create API Keys V1

Official incident.io endpoint: POST /v1/api_keys

Create a new API key. The calling API key can only assign roles whose scopes are a subset of its own. The `api_keys_manage` role cannot be assigned via the API. An organization can have a maximum of 5000 active API keys.

This endpoint requires a valid API key with the `api_keys_manage` role at either the account level or team level.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/api_keys';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
