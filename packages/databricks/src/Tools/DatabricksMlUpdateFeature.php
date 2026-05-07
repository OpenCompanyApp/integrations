<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Ml Update Feature.
 *
 * Maps to the official Databricks SDK endpoint patch /api/2.0/feature-engineering/features/{full_name}.
 */
class DatabricksMlUpdateFeature extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_ml_update_feature';
    protected const DESCRIPTION = 'Ml Update Feature

Official Databricks SDK endpoint: PATCH /api/2.0/feature-engineering/features/{full_name}

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
    protected const METHOD = 'patch';
    protected const PATH = '/api/2.0/feature-engineering/features/{full_name}';
    protected const PATH_PARAMS = array (
  'full_name' => 'full_name',
);
}
