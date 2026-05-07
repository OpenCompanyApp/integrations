<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get monthly usage metrics
 *
 * Maps to Fastly generated client operation BillingUsageMetricsApi::getUsageMetrics (GET /billing/v3/usage-metrics).
 */
class FastlyBillingUsageMetricsGetUsageMetrics extends AbstractFastlyTool
{
    protected const NAME = 'fastly_billing_usage_metrics_get_usage_metrics';
    protected const DESCRIPTION = 'Get monthly usage metrics

Official Fastly client operation: BillingUsageMetricsApi::getUsageMetrics
Endpoint: GET /billing/v3/usage-metrics

Get monthly usage metrics';
    protected const PARAMETERS = array (
  'start_month' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `start_month`.',
  ),
  'end_month' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `end_month`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_billing_usage_metrics_get_usage_metrics',
  'class' => 'FastlyBillingUsageMetricsGetUsageMetrics',
  'api_class' => 'BillingUsageMetricsApi',
  'method_name' => 'getUsageMetrics',
  'method' => 'GET',
  'path' => '/billing/v3/usage-metrics',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get monthly usage metrics',
  'description' => 'Get monthly usage metrics',
  'type' => 'read',
  'parameters' =>
  array (
    'start_month' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `start_month`.',
    ),
    'end_month' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `end_month`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'start_month' => 'start_month',
    'end_month' => 'end_month',
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
