<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Retrieve service-level usage metrics for services with non-zero usage units.
 *
 * Maps to Fastly generated client operation BillingUsageMetricsApi::getServiceLevelUsage (GET /billing/v3/service-usage-metrics).
 */
class FastlyBillingUsageMetricsGetServiceLevelUsage extends AbstractFastlyTool
{
    protected const NAME = 'fastly_billing_usage_metrics_get_service_level_usage';
    protected const DESCRIPTION = 'Retrieve service-level usage metrics for services with non-zero usage units.

Official Fastly client operation: BillingUsageMetricsApi::getServiceLevelUsage
Endpoint: GET /billing/v3/service-usage-metrics

Retrieve service-level usage metrics for services with non-zero usage units.';
    protected const PARAMETERS = array (
  'product_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `product_id`.',
  ),
  'service' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `service`.',
  ),
  'usage_type_name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `usage_type_name`.',
  ),
  'start_month' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `start_month`.',
  ),
  'end_month' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `end_month`.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `limit`.',
  ),
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `cursor`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_billing_usage_metrics_get_service_level_usage',
  'class' => 'FastlyBillingUsageMetricsGetServiceLevelUsage',
  'api_class' => 'BillingUsageMetricsApi',
  'method_name' => 'getServiceLevelUsage',
  'method' => 'GET',
  'path' => '/billing/v3/service-usage-metrics',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Retrieve service-level usage metrics for services with non-zero usage units.',
  'description' => 'Retrieve service-level usage metrics for services with non-zero usage units.',
  'type' => 'read',
  'parameters' =>
  array (
    'product_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `product_id`.',
    ),
    'service' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `service`.',
    ),
    'usage_type_name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `usage_type_name`.',
    ),
    'start_month' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `start_month`.',
    ),
    'end_month' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `end_month`.',
    ),
    'limit' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `limit`.',
    ),
    'cursor' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `cursor`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'product_id' => 'product_id',
    'service' => 'service',
    'usage_type_name' => 'usage_type_name',
    'start_month' => 'start_month',
    'end_month' => 'end_month',
    'limit' => 'limit',
    'cursor' => 'cursor',
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
