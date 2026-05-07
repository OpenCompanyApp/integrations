<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete operation
 *
 * Maps to Fastly generated client operation ApisecurityOperationsApi::apiSecurityDeleteOperation (DELETE /api-security/v1/services/{service_id}/operations/{operation_id}).
 */
class FastlyApisecurityOperationsApiSecurityDeleteOperation extends AbstractFastlyTool
{
    protected const NAME = 'fastly_apisecurity_operations_api_security_delete_operation';
    protected const DESCRIPTION = 'Delete operation

Official Fastly client operation: ApisecurityOperationsApi::apiSecurityDeleteOperation
Endpoint: DELETE /api-security/v1/services/{service_id}/operations/{operation_id}

Delete operation';
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
  'slug' => 'fastly_apisecurity_operations_api_security_delete_operation',
  'class' => 'FastlyApisecurityOperationsApiSecurityDeleteOperation',
  'api_class' => 'ApisecurityOperationsApi',
  'method_name' => 'apiSecurityDeleteOperation',
  'method' => 'DELETE',
  'path' => '/api-security/v1/services/{service_id}/operations/{operation_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete operation',
  'description' => 'Delete operation',
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
