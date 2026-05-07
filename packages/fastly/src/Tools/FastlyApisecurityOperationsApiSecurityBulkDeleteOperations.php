<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Bulk delete operations
 *
 * Maps to Fastly generated client operation ApisecurityOperationsApi::apiSecurityBulkDeleteOperations (DELETE /api-security/v1/services/{service_id}/operations-bulk).
 */
class FastlyApisecurityOperationsApiSecurityBulkDeleteOperations extends AbstractFastlyTool
{
    protected const NAME = 'fastly_apisecurity_operations_api_security_bulk_delete_operations';
    protected const DESCRIPTION = 'Bulk delete operations

Official Fastly client operation: ApisecurityOperationsApi::apiSecurityBulkDeleteOperations
Endpoint: DELETE /api-security/v1/services/{service_id}/operations-bulk

Bulk delete operations';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'operation_bulk_delete' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `operation_bulk_delete`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_apisecurity_operations_api_security_bulk_delete_operations',
  'class' => 'FastlyApisecurityOperationsApiSecurityBulkDeleteOperations',
  'api_class' => 'ApisecurityOperationsApi',
  'method_name' => 'apiSecurityBulkDeleteOperations',
  'method' => 'DELETE',
  'path' => '/api-security/v1/services/{service_id}/operations-bulk',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Bulk delete operations',
  'description' => 'Bulk delete operations',
  'type' => 'write',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'operation_bulk_delete' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `operation_bulk_delete`.',
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
  'body_param' => 'operation_bulk_delete',
  'body_required' => false,
);
}
