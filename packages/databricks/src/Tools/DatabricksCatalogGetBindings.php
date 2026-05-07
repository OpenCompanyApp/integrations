<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Catalog Get Bindings.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.1/unity-catalog/bindings/{securable_type}/{securable_name}.
 */
class DatabricksCatalogGetBindings extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_catalog_get_bindings';
    protected const DESCRIPTION = 'Catalog Get Bindings

Official Databricks SDK endpoint: GET /api/2.1/unity-catalog/bindings/{securable_type}/{securable_name}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'securable_type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `securable_type` from the Databricks SDK endpoint.',
  ),
  'securable_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `securable_name` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.1/unity-catalog/bindings/{securable_type}/{securable_name}';
    protected const PATH_PARAMS = array (
  'securable_type' => 'securable_type',
  'securable_name' => 'securable_name',
);
}
