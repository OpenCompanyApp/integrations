<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Download Connector SDK Package.
 *
 * Maps to the official Fivetran endpoint get /v1/connector-sdk/packages/{package_id}/download.
 */
class FivetranDownloadConnectorSdkPackage extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_download_connector_sdk_package';
    protected const DESCRIPTION = 'Download Connector SDK Package

Official Fivetran endpoint: GET /v1/connector-sdk/packages/{package_id}/download

Downloads the connector code package file (code.zip) for a specific Connector SDK package. This endpoint returns the raw ZIP file as an octet-stream.';
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
    protected const PATH = '/v1/connector-sdk/packages/{package_id}/download';
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
