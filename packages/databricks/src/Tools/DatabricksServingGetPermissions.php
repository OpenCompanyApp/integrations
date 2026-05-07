<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Serving Get Permissions.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/permissions/serving-endpoints/{serving_endpoint_id}.
 */
class DatabricksServingGetPermissions extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_serving_get_permissions';
    protected const DESCRIPTION = 'Serving Get Permissions

Official Databricks SDK endpoint: GET /api/2.0/permissions/serving-endpoints/{serving_endpoint_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'serving_endpoint_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `serving_endpoint_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/permissions/serving-endpoints/{serving_endpoint_id}';
    protected const PATH_PARAMS = array (
  'serving_endpoint_id' => 'serving_endpoint_id',
);
}
