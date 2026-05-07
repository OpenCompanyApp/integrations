<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a new dashboard
 *
 * Maps to Fastly generated client operation ObservabilityCustomDashboardsApi::createDashboard (POST /observability/dashboards).
 */
class FastlyObservabilityCustomDashboardsCreateDashboard extends AbstractFastlyTool
{
    protected const NAME = 'fastly_observability_custom_dashboards_create_dashboard';
    protected const DESCRIPTION = 'Create a new dashboard

Official Fastly client operation: ObservabilityCustomDashboardsApi::createDashboard
Endpoint: POST /observability/dashboards

Create a new dashboard';
    protected const PARAMETERS = array (
  'create_dashboard_request' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `create_dashboard_request`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_observability_custom_dashboards_create_dashboard',
  'class' => 'FastlyObservabilityCustomDashboardsCreateDashboard',
  'api_class' => 'ObservabilityCustomDashboardsApi',
  'method_name' => 'createDashboard',
  'method' => 'POST',
  'path' => '/observability/dashboards',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a new dashboard',
  'description' => 'Create a new dashboard',
  'type' => 'write',
  'parameters' =>
  array (
    'create_dashboard_request' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `create_dashboard_request`.',
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
  'body_param' => 'create_dashboard_request',
  'body_required' => false,
);
}
