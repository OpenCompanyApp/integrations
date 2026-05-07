<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Update API Keys V1.
 *
 * Maps to the official incident.io endpoint put /v1/api_keys/{id}.
 */
class IncidentIoApiKeysV1Update extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_api_keys_v1_update';
    protected const DESCRIPTION = 'Update API Keys V1

Official incident.io endpoint: PUT /v1/api_keys/{id}

Update an existing API key\'s name, roles, or team assignments. All fields must be provided (PUT semantics). The calling API key can only assign roles whose scopes are a subset of its own. An API key cannot edit itself, and the `api_keys_manage` role cannot be assigned via the API.

This endpoint requires a valid API key with the `api_keys_manage` role at either the account level or team level.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier of the API key to update',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
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
