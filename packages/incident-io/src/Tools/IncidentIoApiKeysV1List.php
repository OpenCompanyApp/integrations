<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * List API Keys V1.
 *
 * Maps to the official incident.io endpoint get /v1/api_keys.
 */
class IncidentIoApiKeysV1List extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_api_keys_v1_list';
    protected const DESCRIPTION = 'List API Keys V1

Official incident.io endpoint: GET /v1/api_keys

List API keys visible to the calling API key, with pagination. An API key with account-level `api_keys_manage` access will see all keys, while a key with the `api_keys_manage` role scoped to specific teams will only see keys belonging to those teams.

This endpoint requires a valid API key with the `api_keys_manage` role at either the account level or team level.';
    protected const PARAMETERS = array (
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'Integer number of records to return',
  ),
  'after' =>
  array (
    'type' => 'string',
    'description' => 'An record\'s ID. This endpoint will return a list of records after this ID in relation to the API response order.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/api_keys';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page_size' => 'page_size',
  'after' => 'after',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
