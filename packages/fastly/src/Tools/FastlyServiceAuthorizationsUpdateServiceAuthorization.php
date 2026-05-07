<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update service authorization
 *
 * Maps to Fastly generated client operation ServiceAuthorizationsApi::updateServiceAuthorization (PATCH /service-authorizations/{service_authorization_id}).
 */
class FastlyServiceAuthorizationsUpdateServiceAuthorization extends AbstractFastlyTool
{
    protected const NAME = 'fastly_service_authorizations_update_service_authorization';
    protected const DESCRIPTION = 'Update service authorization

Official Fastly client operation: ServiceAuthorizationsApi::updateServiceAuthorization
Endpoint: PATCH /service-authorizations/{service_authorization_id}

Update service authorization';
    protected const PARAMETERS = array (
  'service_authorization_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_authorization_id`.',
  ),
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
  'slug' => 'fastly_service_authorizations_update_service_authorization',
  'class' => 'FastlyServiceAuthorizationsUpdateServiceAuthorization',
  'api_class' => 'ServiceAuthorizationsApi',
  'method_name' => 'updateServiceAuthorization',
  'method' => 'PATCH',
  'path' => '/service-authorizations/{service_authorization_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update service authorization',
  'description' => 'Update service authorization',
  'type' => 'write',
  'parameters' =>
  array (
    'service_authorization_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_authorization_id`.',
    ),
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
    'service_authorization_id' => 'service_authorization_id',
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
