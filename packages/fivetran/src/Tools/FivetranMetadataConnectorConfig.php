<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Retrieve Connector Configuration Metadata.
 *
 * Maps to the official Fivetran endpoint get /v1/metadata/connector-types/{service}.
 */
class FivetranMetadataConnectorConfig extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_metadata_connector_config';
    protected const DESCRIPTION = 'Retrieve Connector Configuration Metadata

Official Fivetran endpoint: GET /v1/metadata/connector-types/{service}

Returns metadata of configuration parameters and authorization parameters for a specified connector type.';
    protected const PARAMETERS = array (
  'service' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `service` from the official Fivetran API operation. [The connector type](https://fivetran.com/docs/rest-api/getting-started#commonterms) identifier within the Fivetran system',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/metadata/connector-types/{service}';
    protected const PATH_PARAMS = array (
  'service' => 'service',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
