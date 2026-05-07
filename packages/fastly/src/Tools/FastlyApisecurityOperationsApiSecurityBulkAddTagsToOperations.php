<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Bulk add tags to operations
 *
 * Maps to Fastly generated client operation ApisecurityOperationsApi::apiSecurityBulkAddTagsToOperations (POST /api-security/v1/services/{service_id}/operations-bulk-tags).
 */
class FastlyApisecurityOperationsApiSecurityBulkAddTagsToOperations extends AbstractFastlyTool
{
    protected const NAME = 'fastly_apisecurity_operations_api_security_bulk_add_tags_to_operations';
    protected const DESCRIPTION = 'Bulk add tags to operations

Official Fastly client operation: ApisecurityOperationsApi::apiSecurityBulkAddTagsToOperations
Endpoint: POST /api-security/v1/services/{service_id}/operations-bulk-tags

Bulk add tags to operations';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'operation_bulk_add_tags' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `operation_bulk_add_tags`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_apisecurity_operations_api_security_bulk_add_tags_to_operations',
  'class' => 'FastlyApisecurityOperationsApiSecurityBulkAddTagsToOperations',
  'api_class' => 'ApisecurityOperationsApi',
  'method_name' => 'apiSecurityBulkAddTagsToOperations',
  'method' => 'POST',
  'path' => '/api-security/v1/services/{service_id}/operations-bulk-tags',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Bulk add tags to operations',
  'description' => 'Bulk add tags to operations',
  'type' => 'write',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'operation_bulk_add_tags' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `operation_bulk_add_tags`.',
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
  'body_param' => 'operation_bulk_add_tags',
  'body_required' => false,
);
}
