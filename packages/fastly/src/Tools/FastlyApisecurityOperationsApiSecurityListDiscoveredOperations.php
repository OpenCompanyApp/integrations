<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List discovered operations
 *
 * Maps to Fastly generated client operation ApisecurityOperationsApi::apiSecurityListDiscoveredOperations (GET /api-security/v1/services/{service_id}/discovered-operations).
 */
class FastlyApisecurityOperationsApiSecurityListDiscoveredOperations extends AbstractFastlyTool
{
    protected const NAME = 'fastly_apisecurity_operations_api_security_list_discovered_operations';
    protected const DESCRIPTION = 'List discovered operations

Official Fastly client operation: ApisecurityOperationsApi::apiSecurityListDiscoveredOperations
Endpoint: GET /api-security/v1/services/{service_id}/discovered-operations

List discovered operations';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'method' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `method`.',
  ),
  'domain' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `domain`.',
  ),
  'path' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `path`.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `limit`.',
  ),
  'page' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `page`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_apisecurity_operations_api_security_list_discovered_operations',
  'class' => 'FastlyApisecurityOperationsApiSecurityListDiscoveredOperations',
  'api_class' => 'ApisecurityOperationsApi',
  'method_name' => 'apiSecurityListDiscoveredOperations',
  'method' => 'GET',
  'path' => '/api-security/v1/services/{service_id}/discovered-operations',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List discovered operations',
  'description' => 'List discovered operations',
  'type' => 'read',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'method' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `method`.',
    ),
    'domain' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `domain`.',
    ),
    'path' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `path`.',
    ),
    'limit' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `limit`.',
    ),
    'page' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `page`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
  ),
  'query_params' =>
  array (
    'method' => 'method',
    'domain' => 'domain',
    'path' => 'path',
    'limit' => 'limit',
    'page' => 'page',
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
