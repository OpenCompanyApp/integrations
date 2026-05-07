<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Retrieve log insights
 *
 * Maps to Fastly generated client operation InsightsApi::getLogInsights (GET /observability/log-insights).
 */
class FastlyInsightsGetLogInsights extends AbstractFastlyTool
{
    protected const NAME = 'fastly_insights_get_log_insights';
    protected const DESCRIPTION = 'Retrieve log insights

Official Fastly client operation: InsightsApi::getLogInsights
Endpoint: GET /observability/log-insights

Retrieve log insights';
    protected const PARAMETERS = array (
  'visualization' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `visualization`.',
  ),
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'start' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `start`.',
  ),
  'end' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `end`.',
  ),
  'pops' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `pops`.',
  ),
  'domain' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `domain`.',
  ),
  'domain_exact_match' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `domain_exact_match`.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `limit`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_insights_get_log_insights',
  'class' => 'FastlyInsightsGetLogInsights',
  'api_class' => 'InsightsApi',
  'method_name' => 'getLogInsights',
  'method' => 'GET',
  'path' => '/observability/log-insights',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Retrieve log insights',
  'description' => 'Retrieve log insights',
  'type' => 'read',
  'parameters' =>
  array (
    'visualization' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `visualization`.',
    ),
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'start' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `start`.',
    ),
    'end' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `end`.',
    ),
    'pops' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `pops`.',
    ),
    'domain' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `domain`.',
    ),
    'domain_exact_match' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `domain_exact_match`.',
    ),
    'limit' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `limit`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'visualization' => 'visualization',
    'service_id' => 'service_id',
    'start' => 'start',
    'end' => 'end',
    'pops' => 'pops',
    'domain' => 'domain',
    'domain_exact_match' => 'domain_exact_match',
    'limit' => 'limit',
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
