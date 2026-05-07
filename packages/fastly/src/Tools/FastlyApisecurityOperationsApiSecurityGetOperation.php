<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Retrieve operation
 *
 * Maps to Fastly generated client operation ApisecurityOperationsApi::apiSecurityGetOperation (GET /api-security/v1/services/{service_id}/operations/{operation_id}).
 */
class FastlyApisecurityOperationsApiSecurityGetOperation extends AbstractFastlyTool
{
    protected const NAME = 'fastly_apisecurity_operations_api_security_get_operation';
    protected const DESCRIPTION = 'Retrieve operation

Official Fastly client operation: ApisecurityOperationsApi::apiSecurityGetOperation
Endpoint: GET /api-security/v1/services/{service_id}/operations/{operation_id}

Retrieve operation';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'operation_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `operation_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_apisecurity_operations_api_security_get_operation',
  'class' => 'FastlyApisecurityOperationsApiSecurityGetOperation',
  'api_class' => 'ApisecurityOperationsApi',
  'method_name' => 'apiSecurityGetOperation',
  'method' => 'GET',
  'path' => '/api-security/v1/services/{service_id}/operations/{operation_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Retrieve operation',
  'description' => 'Retrieve operation',
  'type' => 'read',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'operation_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `operation_id`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'operation_id' => 'operation_id',
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
