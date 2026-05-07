<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List all custom dashboards
 *
 * Maps to Fastly generated client operation ObservabilityCustomDashboardsApi::listDashboards (GET /observability/dashboards).
 */
class FastlyObservabilityCustomDashboardsListDashboards extends AbstractFastlyTool
{
    protected const NAME = 'fastly_observability_custom_dashboards_list_dashboards';
    protected const DESCRIPTION = 'List all custom dashboards

Official Fastly client operation: ObservabilityCustomDashboardsApi::listDashboards
Endpoint: GET /observability/dashboards

List all custom dashboards';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_observability_custom_dashboards_list_dashboards',
  'class' => 'FastlyObservabilityCustomDashboardsListDashboards',
  'api_class' => 'ObservabilityCustomDashboardsApi',
  'method_name' => 'listDashboards',
  'method' => 'GET',
  'path' => '/observability/dashboards',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List all custom dashboards',
  'description' => 'List all custom dashboards',
  'type' => 'read',
  'parameters' =>
  array (
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
  'body_param' => NULL,
  'body_required' => false,
);
}
