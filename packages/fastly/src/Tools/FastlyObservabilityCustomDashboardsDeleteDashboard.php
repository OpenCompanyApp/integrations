<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete an existing dashboard
 *
 * Maps to Fastly generated client operation ObservabilityCustomDashboardsApi::deleteDashboard (DELETE /observability/dashboards/{dashboard_id}).
 */
class FastlyObservabilityCustomDashboardsDeleteDashboard extends AbstractFastlyTool
{
    protected const NAME = 'fastly_observability_custom_dashboards_delete_dashboard';
    protected const DESCRIPTION = 'Delete an existing dashboard

Official Fastly client operation: ObservabilityCustomDashboardsApi::deleteDashboard
Endpoint: DELETE /observability/dashboards/{dashboard_id}

Delete an existing dashboard';
    protected const PARAMETERS = array (
  'dashboard_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `dashboard_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_observability_custom_dashboards_delete_dashboard',
  'class' => 'FastlyObservabilityCustomDashboardsDeleteDashboard',
  'api_class' => 'ObservabilityCustomDashboardsApi',
  'method_name' => 'deleteDashboard',
  'method' => 'DELETE',
  'path' => '/observability/dashboards/{dashboard_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete an existing dashboard',
  'description' => 'Delete an existing dashboard',
  'type' => 'write',
  'parameters' =>
  array (
    'dashboard_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `dashboard_id`.',
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
  'body_param' => NULL,
  'body_required' => false,
);
}
