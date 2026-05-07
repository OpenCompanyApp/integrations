<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * List All Connector SDK Packages.
 *
 * Maps to the official Fivetran endpoint get /v1/connector-sdk/packages.
 */
class FivetranListConnectorSdkPackages extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_list_connector_sdk_packages';
    protected const DESCRIPTION = 'List All Connector SDK Packages

Official Fivetran endpoint: GET /v1/connector-sdk/packages

Returns a list of all Connector SDK packages in your Fivetran account.';
    protected const PARAMETERS = array (
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `cursor` from the official Fivetran API operation. Paging cursor, [read more about pagination](https://fivetran.com/docs/rest-api/pagination)',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Fivetran API operation. Number of records to fetch per page. Accepts a number in the range 1..1000; the default value is 100.',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/connector-sdk/packages';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
