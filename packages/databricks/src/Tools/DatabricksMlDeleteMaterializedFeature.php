<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Ml Delete Materialized Feature.
 *
 * Maps to the official Databricks SDK endpoint delete /api/2.0/feature-engineering/materialized-features/{materialized_feature_id}.
 */
class DatabricksMlDeleteMaterializedFeature extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_ml_delete_materialized_feature';
    protected const DESCRIPTION = 'Ml Delete Materialized Feature

Official Databricks SDK endpoint: DELETE /api/2.0/feature-engineering/materialized-features/{materialized_feature_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'materialized_feature_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `materialized_feature_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/feature-engineering/materialized-features/{materialized_feature_id}';
    protected const PATH_PARAMS = array (
  'materialized_feature_id' => 'materialized_feature_id',
);
}
