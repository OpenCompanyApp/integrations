<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Rotate API Keys V1.
 *
 * Maps to the official incident.io endpoint post /v1/api_keys/{id}/actions/rotate.
 */
class IncidentIoApiKeysV1Rotate extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_api_keys_v1_rotate';
    protected const DESCRIPTION = 'Rotate API Keys V1

Official incident.io endpoint: POST /v1/api_keys/{id}/actions/rotate

Rotate the access token for an API key. This generates a new bearer token and optionally keeps the old token valid for a configurable grace period (up to 60 minutes), allowing a seamless rollover without downtime. The calling API key must have all the scopes of the key being rotated.

This endpoint requires a valid API key with the `api_keys_manage` role at either the account level or team level.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier of the API key to rotate',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/api_keys/{id}/actions/rotate';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
