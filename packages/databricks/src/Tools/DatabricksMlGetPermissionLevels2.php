<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Ml Get Permission Levels.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/permissions/registered-models/{registered_model_id}/permissionLevels.
 */
class DatabricksMlGetPermissionLevels2 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_ml_get_permission_levels_2';
    protected const DESCRIPTION = 'Ml Get Permission Levels

Official Databricks SDK endpoint: GET /api/2.0/permissions/registered-models/{registered_model_id}/permissionLevels

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'registered_model_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `registered_model_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/permissions/registered-models/{registered_model_id}/permissionLevels';
    protected const PATH_PARAMS = array (
  'registered_model_id' => 'registered_model_id',
);
}
