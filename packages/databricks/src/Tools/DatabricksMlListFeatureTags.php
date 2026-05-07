<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Ml List Feature Tags.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/feature-store/feature-tables/{table_name}/features/{feature_name}/tags.
 */
class DatabricksMlListFeatureTags extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_ml_list_feature_tags';
    protected const DESCRIPTION = 'Ml List Feature Tags

Official Databricks SDK endpoint: GET /api/2.0/feature-store/feature-tables/{table_name}/features/{feature_name}/tags

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'table_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `table_name` from the Databricks SDK endpoint.',
  ),
  'feature_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `feature_name` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/feature-store/feature-tables/{table_name}/features/{feature_name}/tags';
    protected const PATH_PARAMS = array (
  'table_name' => 'table_name',
  'feature_name' => 'feature_name',
);
}
