<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Ml Get Permissions.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/permissions/registered-models/{registered_model_id}.
 */
class DatabricksMlGetPermissions2 extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_ml_get_permissions_2';
    protected const DESCRIPTION = 'Ml Get Permissions

Official Databricks SDK endpoint: GET /api/2.0/permissions/registered-models/{registered_model_id}

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
    protected const PATH = '/api/2.0/permissions/registered-models/{registered_model_id}';
    protected const PATH_PARAMS = array (
  'registered_model_id' => 'registered_model_id',
);
}
