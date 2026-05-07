<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Ml Get Feature.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/feature-engineering/features/{full_name}.
 */
class DatabricksMlGetFeature extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_ml_get_feature';
    protected const DESCRIPTION = 'Ml Get Feature

Official Databricks SDK endpoint: GET /api/2.0/feature-engineering/features/{full_name}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'full_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `full_name` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/feature-engineering/features/{full_name}';
    protected const PATH_PARAMS = array (
  'full_name' => 'full_name',
);
}
