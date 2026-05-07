<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Catalog Update.
 *
 * Maps to the official Databricks SDK endpoint patch /api/2.1/unity-catalog/models/{full_name}/versions/{version}.
 */
class DatabricksCatalogUpdate12 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_catalog_update_12';
    protected const DESCRIPTION = 'Catalog Update

Official Databricks SDK endpoint: PATCH /api/2.1/unity-catalog/models/{full_name}/versions/{version}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'full_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `full_name` from the Databricks SDK endpoint.',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `version` from the Databricks SDK endpoint.',
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
    protected const METHOD = 'patch';
    protected const PATH = '/api/2.1/unity-catalog/models/{full_name}/versions/{version}';
    protected const PATH_PARAMS = array (
  'full_name' => 'full_name',
  'version' => 'version',
);
}
