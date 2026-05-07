<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Update Connector SDK Package.
 *
 * Maps to the official Fivetran endpoint patch /v1/connector-sdk/packages/{package_id}.
 */
class FivetranUpdateConnectorSdkPackage extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_update_connector_sdk_package';
    protected const DESCRIPTION = 'Update Connector SDK Package

Official Fivetran endpoint: PATCH /v1/connector-sdk/packages/{package_id}

Updates an existing Connector SDK package by uploading a new version of the connector code. All connections using this package will automatically use the updated code on their next sync.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Fivetran API request schema.',
  ),
);
    protected const METHOD = 'patch';
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
