<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List operations
 *
 * Maps to Fastly generated client operation ApisecurityOperationsApi::apiSecurityListOperations (GET /api-security/v1/services/{service_id}/operations).
 */
class FastlyApisecurityOperationsApiSecurityListOperations extends AbstractFastlyTool
{
    protected const NAME = 'fastly_apisecurity_operations_api_security_list_operations';
    protected const DESCRIPTION = 'List operations

Official Fastly client operation: ApisecurityOperationsApi::apiSecurityListOperations
Endpoint: GET /api-security/v1/services/{service_id}/operations

List operations';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'tag_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `tag_id`.',
  ),
  'status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `status`.',
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
  'slug' => 'fastly_apisecurity_operations_api_security_list_operations',
  'class' => 'FastlyApisecurityOperationsApiSecurityListOperations',
  'api_class' => 'ApisecurityOperationsApi',
  'method_name' => 'apiSecurityListOperations',
  'method' => 'GET',
  'path' => '/api-security/v1/services/{service_id}/operations',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List operations',
  'description' => 'List operations',
  'type' => 'read',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'tag_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `tag_id`.',
    ),
    'status' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `status`.',
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
    'tag_id' => 'tag_id',
    'status' => 'status',
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
