<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create service authorization
 *
 * Maps to Fastly generated client operation ServiceAuthorizationsApi::createServiceAuthorization (POST /service-authorizations).
 */
class FastlyServiceAuthorizationsCreateServiceAuthorization extends AbstractFastlyTool
{
    protected const NAME = 'fastly_service_authorizations_create_service_authorization';
    protected const DESCRIPTION = 'Create service authorization

Official Fastly client operation: ServiceAuthorizationsApi::createServiceAuthorization
Endpoint: POST /service-authorizations

Create service authorization';
    protected const PARAMETERS = array (
  'service_authorization' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `service_authorization`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_service_authorizations_create_service_authorization',
  'class' => 'FastlyServiceAuthorizationsCreateServiceAuthorization',
  'api_class' => 'ServiceAuthorizationsApi',
  'method_name' => 'createServiceAuthorization',
  'method' => 'POST',
  'path' => '/service-authorizations',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create service authorization',
  'description' => 'Create service authorization',
  'type' => 'write',
  'parameters' =>
  array (
    'service_authorization' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `service_authorization`.',
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
  'body_param' => 'service_authorization',
  'body_required' => false,
);
}
