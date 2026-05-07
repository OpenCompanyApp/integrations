<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Bulk create operations
 *
 * Maps to Fastly generated client operation ApisecurityOperationsApi::apiSecurityBulkCreateOperations (POST /api-security/v1/services/{service_id}/operations-bulk).
 */
class FastlyApisecurityOperationsApiSecurityBulkCreateOperations extends AbstractFastlyTool
{
    protected const NAME = 'fastly_apisecurity_operations_api_security_bulk_create_operations';
    protected const DESCRIPTION = 'Bulk create operations

Official Fastly client operation: ApisecurityOperationsApi::apiSecurityBulkCreateOperations
Endpoint: POST /api-security/v1/services/{service_id}/operations-bulk

Bulk create operations';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'operation_bulk_create' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `operation_bulk_create`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_apisecurity_operations_api_security_bulk_create_operations',
  'class' => 'FastlyApisecurityOperationsApiSecurityBulkCreateOperations',
  'api_class' => 'ApisecurityOperationsApi',
  'method_name' => 'apiSecurityBulkCreateOperations',
  'method' => 'POST',
  'path' => '/api-security/v1/services/{service_id}/operations-bulk',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Bulk create operations',
  'description' => 'Bulk create operations',
  'type' => 'write',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'operation_bulk_create' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `operation_bulk_create`.',
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
  'body_param' => 'operation_bulk_create',
  'body_required' => false,
);
}
