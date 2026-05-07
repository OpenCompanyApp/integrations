<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Show API Keys V1.
 *
 * Maps to the official incident.io endpoint get /v1/api_keys/{id}.
 */
class IncidentIoApiKeysV1Show extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_api_keys_v1_show';
    protected const DESCRIPTION = 'Show API Keys V1

Official incident.io endpoint: GET /v1/api_keys/{id}

Show details of a specific API key, including its roles, team assignments and when its token was last issued.

This endpoint requires a valid API key with the `api_keys_manage` role at either the account level or team level.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier of the API key to retrieve',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
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
