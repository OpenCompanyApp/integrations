<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Dashboards Update.
 *
 * Maps to the official Databricks SDK endpoint patch /api/2.0/lakeview/dashboards/{dashboard_id}.
 */
class DatabricksDashboardsUpdate extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_dashboards_update';
    protected const DESCRIPTION = 'Dashboards Update

Official Databricks SDK endpoint: PATCH /api/2.0/lakeview/dashboards/{dashboard_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'dashboard_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `dashboard_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/lakeview/dashboards/{dashboard_id}';
    protected const PATH_PARAMS = array (
  'dashboard_id' => 'dashboard_id',
);
}
