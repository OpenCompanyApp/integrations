<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Sharing List Provider Share Assets.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.1/data-sharing/providers/{provider_name}/shares/{share_name}.
 */
class DatabricksSharingListProviderShareAssets extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_sharing_list_provider_share_assets';
    protected const DESCRIPTION = 'Sharing List Provider Share Assets

Official Databricks SDK endpoint: GET /api/2.1/data-sharing/providers/{provider_name}/shares/{share_name}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'provider_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `provider_name` from the Databricks SDK endpoint.',
  ),
  'share_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `share_name` from the Databricks SDK endpoint.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'description' => 'Optional query string parameters matching the Databricks REST API request fields.',
  ),
  'headers' =>
  array (
    'type' => 'object',
    'description' => 'Optional additional request headers for advanced Databricks endpoints.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'Optional JSON request body matching the Databricks REST API request fields.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/2.1/data-sharing/providers/{provider_name}/shares/{share_name}';
    protected const PATH_PARAMS = array (
  'provider_name' => 'provider_name',
  'share_name' => 'share_name',
);
}
