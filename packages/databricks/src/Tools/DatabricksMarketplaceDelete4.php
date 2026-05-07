<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Marketplace Delete.
 *
 * Maps to the official Databricks SDK endpoint delete /api/2.0/marketplace-provider/files/{file_id}.
 */
class DatabricksMarketplaceDelete4 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_marketplace_delete_4';
    protected const DESCRIPTION = 'Marketplace Delete

Official Databricks SDK endpoint: DELETE /api/2.0/marketplace-provider/files/{file_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'file_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `file_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/marketplace-provider/files/{file_id}';
    protected const PATH_PARAMS = array (
  'file_id' => 'file_id',
);
}
