<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get services with product enabled
 *
 * Maps to Fastly generated client operation ProductLogExplorerInsightsApi::getServicesProductLogExplorerInsights (GET /enabled-products/v1/log_explorer_insights/services).
 */
class FastlyProductLogExplorerInsightsGetServicesProductLogExplorerInsights extends AbstractFastlyTool
{
    protected const NAME = 'fastly_product_log_explorer_insights_get_services_product_log_explorer_insights';
    protected const DESCRIPTION = 'Get services with product enabled

Official Fastly client operation: ProductLogExplorerInsightsApi::getServicesProductLogExplorerInsights
Endpoint: GET /enabled-products/v1/log_explorer_insights/services

Get services with product enabled';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_product_log_explorer_insights_get_services_product_log_explorer_insights',
  'class' => 'FastlyProductLogExplorerInsightsGetServicesProductLogExplorerInsights',
  'api_class' => 'ProductLogExplorerInsightsApi',
  'method_name' => 'getServicesProductLogExplorerInsights',
  'method' => 'GET',
  'path' => '/enabled-products/v1/log_explorer_insights/services',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get services with product enabled',
  'description' => 'Get services with product enabled',
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
