<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update an existing dashboard
 *
 * Maps to Fastly generated client operation ObservabilityCustomDashboardsApi::updateDashboard (PATCH /observability/dashboards/{dashboard_id}).
 */
class FastlyObservabilityCustomDashboardsUpdateDashboard extends AbstractFastlyTool
{
    protected const NAME = 'fastly_observability_custom_dashboards_update_dashboard';
    protected const DESCRIPTION = 'Update an existing dashboard

Official Fastly client operation: ObservabilityCustomDashboardsApi::updateDashboard
Endpoint: PATCH /observability/dashboards/{dashboard_id}

Update an existing dashboard';
    protected const PARAMETERS = array (
  'dashboard_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `dashboard_id`.',
  ),
  'update_dashboard_request' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `update_dashboard_request`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_observability_custom_dashboards_update_dashboard',
  'class' => 'FastlyObservabilityCustomDashboardsUpdateDashboard',
  'api_class' => 'ObservabilityCustomDashboardsApi',
  'method_name' => 'updateDashboard',
  'method' => 'PATCH',
  'path' => '/observability/dashboards/{dashboard_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update an existing dashboard',
  'description' => 'Update an existing dashboard',
  'type' => 'write',
  'parameters' =>
  array (
    'dashboard_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `dashboard_id`.',
    ),
    'update_dashboard_request' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `update_dashboard_request`.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Alias for the JSON request body.',
    ),
  ),
  'path_params' =>
  array (
    'dashboard_id' => 'dashboard_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'form_params' =>
  array (
  ),
  'body_param' => 'update_dashboard_request',
  'body_required' => false,
);
}
