<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Dashboards Create Subscription.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.0/lakeview/dashboards/{dashboard_id}/schedules/{schedule_id}/subscriptions.
 */
class DatabricksDashboardsCreateSubscription extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_dashboards_create_subscription';
    protected const DESCRIPTION = 'Dashboards Create Subscription

Official Databricks SDK endpoint: POST /api/2.0/lakeview/dashboards/{dashboard_id}/schedules/{schedule_id}/subscriptions

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'dashboard_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `dashboard_id` from the Databricks SDK endpoint.',
  ),
  'schedule_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `schedule_id` from the Databricks SDK endpoint.',
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
    protected const METHOD = 'post';
    protected const PATH = '/api/2.0/lakeview/dashboards/{dashboard_id}/schedules/{schedule_id}/subscriptions';
    protected const PATH_PARAMS = array (
  'dashboard_id' => 'dashboard_id',
  'schedule_id' => 'schedule_id',
);
}
