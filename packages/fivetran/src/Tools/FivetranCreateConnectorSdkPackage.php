<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Create Connector SDK Package.
 *
 * Maps to the official Fivetran endpoint post /v1/connector-sdk/packages.
 */
class FivetranCreateConnectorSdkPackage extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_create_connector_sdk_package';
    protected const DESCRIPTION = 'Create Connector SDK Package

Official Fivetran endpoint: POST /v1/connector-sdk/packages

Uploads a new Connector SDK package to your Fivetran account. The package must be a ZIP file containing your custom connector code. You can create the package ZIP file using the [`fivetran package` command](/docs/connector-sdk/connector-development-and-configuration/connector-sdk-commands#fivetranpackage). After creating a package, use the standard [Create a Connection endpoint](/docs/rest-api/api-reference/connections/create-connection) with the returned `id` as `package_id` in the config. > NOTE: Each package can only be associated with one connection at a time.';
    protected const PARAMETERS = array (
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
    protected const PATH = '/v1/connector-sdk/packages';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
