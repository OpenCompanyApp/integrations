<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update operation tag
 *
 * Maps to Fastly generated client operation ApisecurityOperationsApi::apiSecurityUpdateOperationTag (PATCH /api-security/v1/services/{service_id}/tags/{tag_id}).
 */
class FastlyApisecurityOperationsApiSecurityUpdateOperationTag extends AbstractFastlyTool
{
    protected const NAME = 'fastly_apisecurity_operations_api_security_update_operation_tag';
    protected const DESCRIPTION = 'Update operation tag

Official Fastly client operation: ApisecurityOperationsApi::apiSecurityUpdateOperationTag
Endpoint: PATCH /api-security/v1/services/{service_id}/tags/{tag_id}

Update operation tag';
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
    'required' => true,
    'description' => 'Fastly API parameter `tag_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_apisecurity_operations_api_security_update_operation_tag',
  'class' => 'FastlyApisecurityOperationsApiSecurityUpdateOperationTag',
  'api_class' => 'ApisecurityOperationsApi',
  'method_name' => 'apiSecurityUpdateOperationTag',
  'method' => 'PATCH',
  'path' => '/api-security/v1/services/{service_id}/tags/{tag_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update operation tag',
  'description' => 'Update operation tag',
  'type' => 'write',
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
      'required' => true,
      'description' => 'Fastly API parameter `tag_id`.',
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
    'tag_id' => 'tag_id',
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
  'body_param' => 'body',
  'body_required' => false,
);
}
