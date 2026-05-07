<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Settings Delete.
 *
 * Maps to the official Databricks SDK endpoint delete /api/2.0/token-management/tokens/{token_id}.
 */
class DatabricksSettingsDelete17 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_settings_delete_17';
    protected const DESCRIPTION = 'Settings Delete

Official Databricks SDK endpoint: DELETE /api/2.0/token-management/tokens/{token_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'token_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `token_id` from the Databricks SDK endpoint.',
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
    protected const METHOD = 'delete';
    protected const PATH = '/api/2.0/token-management/tokens/{token_id}';
    protected const PATH_PARAMS = array (
  'token_id' => 'token_id',
);
}
