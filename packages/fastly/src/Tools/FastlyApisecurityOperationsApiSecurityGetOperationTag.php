<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Retrieve operation tag
 *
 * Maps to Fastly generated client operation ApisecurityOperationsApi::apiSecurityGetOperationTag (GET /api-security/v1/services/{service_id}/tags/{tag_id}).
 */
class FastlyApisecurityOperationsApiSecurityGetOperationTag extends AbstractFastlyTool
{
    protected const NAME = 'fastly_apisecurity_operations_api_security_get_operation_tag';
    protected const DESCRIPTION = 'Retrieve operation tag

Official Fastly client operation: ApisecurityOperationsApi::apiSecurityGetOperationTag
Endpoint: GET /api-security/v1/services/{service_id}/tags/{tag_id}

Retrieve operation tag';
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
  'slug' => 'fastly_apisecurity_operations_api_security_get_operation_tag',
  'class' => 'FastlyApisecurityOperationsApiSecurityGetOperationTag',
  'api_class' => 'ApisecurityOperationsApi',
  'method_name' => 'apiSecurityGetOperationTag',
  'method' => 'GET',
  'path' => '/api-security/v1/services/{service_id}/tags/{tag_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Retrieve operation tag',
  'description' => 'Retrieve operation tag',
  'type' => 'read',
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
