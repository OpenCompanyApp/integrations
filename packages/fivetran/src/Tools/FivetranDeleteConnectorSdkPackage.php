<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Delete Connector SDK Package.
 *
 * Maps to the official Fivetran endpoint delete /v1/connector-sdk/packages/{package_id}.
 */
class FivetranDeleteConnectorSdkPackage extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_delete_connector_sdk_package';
    protected const DESCRIPTION = 'Delete Connector SDK Package

Official Fivetran endpoint: DELETE /v1/connector-sdk/packages/{package_id}

Permanently deletes a Connector SDK package from your Fivetran account. > **Warning:** Packages that are associated with a connection cannot be deleted. You must first delete the connection before deleting the package.';
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
    protected const METHOD = 'delete';
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
