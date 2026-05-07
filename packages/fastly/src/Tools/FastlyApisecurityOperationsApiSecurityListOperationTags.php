<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List operation tags
 *
 * Maps to Fastly generated client operation ApisecurityOperationsApi::apiSecurityListOperationTags (GET /api-security/v1/services/{service_id}/tags).
 */
class FastlyApisecurityOperationsApiSecurityListOperationTags extends AbstractFastlyTool
{
    protected const NAME = 'fastly_apisecurity_operations_api_security_list_operation_tags';
    protected const DESCRIPTION = 'List operation tags

Official Fastly client operation: ApisecurityOperationsApi::apiSecurityListOperationTags
Endpoint: GET /api-security/v1/services/{service_id}/tags

List operation tags';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `limit`.',
  ),
  'page' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `page`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_apisecurity_operations_api_security_list_operation_tags',
  'class' => 'FastlyApisecurityOperationsApiSecurityListOperationTags',
  'api_class' => 'ApisecurityOperationsApi',
  'method_name' => 'apiSecurityListOperationTags',
  'method' => 'GET',
  'path' => '/api-security/v1/services/{service_id}/tags',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List operation tags',
  'description' => 'List operation tags',
  'type' => 'read',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'limit' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `limit`.',
    ),
    'page' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `page`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
  ),
  'query_params' =>
  array (
    'limit' => 'limit',
    'page' => 'page',
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
