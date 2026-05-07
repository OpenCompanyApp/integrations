<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create operation
 *
 * Maps to Fastly generated client operation ApisecurityOperationsApi::apiSecurityCreateOperation (POST /api-security/v1/services/{service_id}/operations).
 */
class FastlyApisecurityOperationsApiSecurityCreateOperation extends AbstractFastlyTool
{
    protected const NAME = 'fastly_apisecurity_operations_api_security_create_operation';
    protected const DESCRIPTION = 'Create operation

Official Fastly client operation: ApisecurityOperationsApi::apiSecurityCreateOperation
Endpoint: POST /api-security/v1/services/{service_id}/operations

Create operation';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'operation_create' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `operation_create`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_apisecurity_operations_api_security_create_operation',
  'class' => 'FastlyApisecurityOperationsApiSecurityCreateOperation',
  'api_class' => 'ApisecurityOperationsApi',
  'method_name' => 'apiSecurityCreateOperation',
  'method' => 'POST',
  'path' => '/api-security/v1/services/{service_id}/operations',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create operation',
  'description' => 'Create operation',
  'type' => 'write',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'operation_create' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `operation_create`.',
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
  'body_param' => 'operation_create',
  'body_required' => false,
);
}
