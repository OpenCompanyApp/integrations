<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete operation tag
 *
 * Maps to Fastly generated client operation ApisecurityOperationsApi::apiSecurityDeleteOperationTag (DELETE /api-security/v1/services/{service_id}/tags/{tag_id}).
 */
class FastlyApisecurityOperationsApiSecurityDeleteOperationTag extends AbstractFastlyTool
{
    protected const NAME = 'fastly_apisecurity_operations_api_security_delete_operation_tag';
    protected const DESCRIPTION = 'Delete operation tag

Official Fastly client operation: ApisecurityOperationsApi::apiSecurityDeleteOperationTag
Endpoint: DELETE /api-security/v1/services/{service_id}/tags/{tag_id}

Delete operation tag';
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
);
    protected const OPERATION = array (
  'slug' => 'fastly_apisecurity_operations_api_security_delete_operation_tag',
  'class' => 'FastlyApisecurityOperationsApiSecurityDeleteOperationTag',
  'api_class' => 'ApisecurityOperationsApi',
  'method_name' => 'apiSecurityDeleteOperationTag',
  'method' => 'DELETE',
  'path' => '/api-security/v1/services/{service_id}/tags/{tag_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete operation tag',
  'description' => 'Delete operation tag',
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
  'body_param' => NULL,
  'body_required' => false,
);
}
