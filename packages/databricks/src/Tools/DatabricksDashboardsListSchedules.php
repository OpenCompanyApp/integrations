<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Dashboards List Schedules.
 *
 * Maps to the official Databricks SDK endpoint get /api/2.0/lakeview/dashboards/{dashboard_id}/schedules.
 */
class DatabricksDashboardsListSchedules extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_dashboards_list_schedules';
    protected const DESCRIPTION = 'Dashboards List Schedules

Official Databricks SDK endpoint: GET /api/2.0/lakeview/dashboards/{dashboard_id}/schedules

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
    protected const METHOD = 'get';
    protected const PATH = '/api/2.0/lakeview/dashboards/{dashboard_id}/schedules';
    protected const PATH_PARAMS = array (
  'dashboard_id' => 'dashboard_id',
);
}
