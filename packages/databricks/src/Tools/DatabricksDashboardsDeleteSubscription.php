<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Dashboards Delete Subscription.
 *
 * Maps to the official Databricks SDK endpoint delete /api/2.0/lakeview/dashboards/{dashboard_id}/schedules/{schedule_id}/subscriptions/{subscription_id}.
 */
class DatabricksDashboardsDeleteSubscription extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_dashboards_delete_subscription';
    protected const DESCRIPTION = 'Dashboards Delete Subscription

Official Databricks SDK endpoint: DELETE /api/2.0/lakeview/dashboards/{dashboard_id}/schedules/{schedule_id}/subscriptions/{subscription_id}

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
  'subscription_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `subscription_id` from the Databricks SDK endpoint.',
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
    protected const PATH = '/api/2.0/lakeview/dashboards/{dashboard_id}/schedules/{schedule_id}/subscriptions/{subscription_id}';
    protected const PATH_PARAMS = array (
  'dashboard_id' => 'dashboard_id',
  'schedule_id' => 'schedule_id',
  'subscription_id' => 'subscription_id',
);
}
