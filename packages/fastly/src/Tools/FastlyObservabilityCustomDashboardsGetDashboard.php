<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Retrieve a dashboard by ID
 *
 * Maps to Fastly generated client operation ObservabilityCustomDashboardsApi::getDashboard (GET /observability/dashboards/{dashboard_id}).
 */
class FastlyObservabilityCustomDashboardsGetDashboard extends AbstractFastlyTool
{
    protected const NAME = 'fastly_observability_custom_dashboards_get_dashboard';
    protected const DESCRIPTION = 'Retrieve a dashboard by ID

Official Fastly client operation: ObservabilityCustomDashboardsApi::getDashboard
Endpoint: GET /observability/dashboards/{dashboard_id}

Retrieve a dashboard by ID';
    protected const PARAMETERS = array (
  'dashboard_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `dashboard_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_observability_custom_dashboards_get_dashboard',
  'class' => 'FastlyObservabilityCustomDashboardsGetDashboard',
  'api_class' => 'ObservabilityCustomDashboardsApi',
  'method_name' => 'getDashboard',
  'method' => 'GET',
  'path' => '/observability/dashboards/{dashboard_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Retrieve a dashboard by ID',
  'description' => 'Retrieve a dashboard by ID',
  'type' => 'read',
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
