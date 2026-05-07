<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Catalog Delete.
 *
 * Maps to the official Databricks SDK endpoint delete /api/2.1/unity-catalog/functions/{name}.
 */
class DatabricksCatalogDelete8 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_catalog_delete_8';
    protected const DESCRIPTION = 'Catalog Delete

Official Databricks SDK endpoint: DELETE /api/2.1/unity-catalog/functions/{name}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.1/unity-catalog/functions/{name}';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
}
