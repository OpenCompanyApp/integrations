<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Dashboards Get Space.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/genie/spaces/{space_id}.
 */
class DatabricksDashboardsGetSpace extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_dashboards_get_space';
    protected const DESCRIPTION = 'Dashboards Get Space

Official Databricks SDK endpoint: GET /api/2.0/genie/spaces/{space_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'space_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `space_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/genie/spaces/{space_id}';
    protected const PATH_PARAMS = array (
  'space_id' => 'space_id',
);
}
