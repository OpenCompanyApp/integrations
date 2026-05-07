<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Catalog Disable.
 *
 * Maps to the official Databricks SDK endpoint delete /api/2.1/unity-catalog/metastores/{metastore_id}/systemschemas/{schema_name}.
 */
class DatabricksCatalogDisable extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_catalog_disable';
    protected const DESCRIPTION = 'Catalog Disable

Official Databricks SDK endpoint: DELETE /api/2.1/unity-catalog/metastores/{metastore_id}/systemschemas/{schema_name}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'metastore_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `metastore_id` from the Databricks SDK endpoint.',
  ),
  'schema_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `schema_name` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.1/unity-catalog/metastores/{metastore_id}/systemschemas/{schema_name}';
    protected const PATH_PARAMS = array (
  'metastore_id' => 'metastore_id',
  'schema_name' => 'schema_name',
);
}
