<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Set Up a New Connection Schema Config.
 *
 * Maps to the official Fivetran endpoint post /v1/connections/{connectionId}/schemas.
 */
class FivetranPreCreateConnectionSchemaConfig extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_pre_create_connection_schema_config';
    protected const DESCRIPTION = 'Set Up a New Connection Schema Config

Official Fivetran endpoint: POST /v1/connections/{connectionId}/schemas

Configures a Connection Schema for a new connection before the schema is captured from the source. > Note: The response returns the exact settings provided in the request. After the initial sync, when the connection captures the schema from the source, Fivetran attempts to apply the specified settings to the actual schema. If certain tables or columns cannot be excluded, the settings for those entities are ignored.';
    protected const PARAMETERS = array (
  'connection_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `connectionId` from the official Fivetran API operation. The unique identifier for the connection within the Fivetran system.',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Fivetran API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/connections/{connectionId}/schemas';
    protected const PATH_PARAMS = array (
  'connectionId' => 'connection_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
