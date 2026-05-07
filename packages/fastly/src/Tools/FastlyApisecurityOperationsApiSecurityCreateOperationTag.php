<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create operation tag
 *
 * Maps to Fastly generated client operation ApisecurityOperationsApi::apiSecurityCreateOperationTag (POST /api-security/v1/services/{service_id}/tags).
 */
class FastlyApisecurityOperationsApiSecurityCreateOperationTag extends AbstractFastlyTool
{
    protected const NAME = 'fastly_apisecurity_operations_api_security_create_operation_tag';
    protected const DESCRIPTION = 'Create operation tag

Official Fastly client operation: ApisecurityOperationsApi::apiSecurityCreateOperationTag
Endpoint: POST /api-security/v1/services/{service_id}/tags

Create operation tag';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'tag_create' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `tag_create`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_apisecurity_operations_api_security_create_operation_tag',
  'class' => 'FastlyApisecurityOperationsApiSecurityCreateOperationTag',
  'api_class' => 'ApisecurityOperationsApi',
  'method_name' => 'apiSecurityCreateOperationTag',
  'method' => 'POST',
  'path' => '/api-security/v1/services/{service_id}/tags',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create operation tag',
  'description' => 'Create operation tag',
  'type' => 'write',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'tag_create' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `tag_create`.',
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
  'body_param' => 'tag_create',
  'body_required' => false,
);
}
