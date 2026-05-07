<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update operation
 *
 * Maps to Fastly generated client operation ApisecurityOperationsApi::apiSecurityUpdateOperation (PATCH /api-security/v1/services/{service_id}/operations/{operation_id}).
 */
class FastlyApisecurityOperationsApiSecurityUpdateOperation extends AbstractFastlyTool
{
    protected const NAME = 'fastly_apisecurity_operations_api_security_update_operation';
    protected const DESCRIPTION = 'Update operation

Official Fastly client operation: ApisecurityOperationsApi::apiSecurityUpdateOperation
Endpoint: PATCH /api-security/v1/services/{service_id}/operations/{operation_id}

Update operation';
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
  'operation_update' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `operation_update`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_apisecurity_operations_api_security_update_operation',
  'class' => 'FastlyApisecurityOperationsApiSecurityUpdateOperation',
  'api_class' => 'ApisecurityOperationsApi',
  'method_name' => 'apiSecurityUpdateOperation',
  'method' => 'PATCH',
  'path' => '/api-security/v1/services/{service_id}/operations/{operation_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update operation',
  'description' => 'Update operation',
  'type' => 'write',
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
    'operation_update' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `operation_update`.',
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
  'body_param' => 'operation_update',
  'body_required' => false,
);
}
