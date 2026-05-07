<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Retrieve Connector SDK Package Details.
 *
 * Maps to the official Fivetran endpoint get /v1/connector-sdk/packages/{package_id}.
 */
class FivetranGetConnectorSdkPackage extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_get_connector_sdk_package';
    protected const DESCRIPTION = 'Retrieve Connector SDK Package Details

Official Fivetran endpoint: GET /v1/connector-sdk/packages/{package_id}

Returns details for a specific Connector SDK package.';
    protected const PARAMETERS = array (
  'package_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `package_id` from the official Fivetran API operation. The unique identifier for the Connector SDK package.',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/connector-sdk/packages/{package_id}';
    protected const PATH_PARAMS = array (
  'package_id' => 'package_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
