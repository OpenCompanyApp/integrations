<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update service authorizations
 *
 * Maps to Fastly generated client operation ServiceAuthorizationsApi::updateServiceAuthorization2 (PATCH /service-authorizations).
 */
class FastlyServiceAuthorizationsUpdateServiceAuthorization2 extends AbstractFastlyTool
{
    protected const NAME = 'fastly_service_authorizations_update_service_authorization2';
    protected const DESCRIPTION = 'Update service authorizations

Official Fastly client operation: ServiceAuthorizationsApi::updateServiceAuthorization2
Endpoint: PATCH /service-authorizations

Update service authorizations';
    protected const PARAMETERS = array (
  'request_body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `request_body`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_service_authorizations_update_service_authorization2',
  'class' => 'FastlyServiceAuthorizationsUpdateServiceAuthorization2',
  'api_class' => 'ServiceAuthorizationsApi',
  'method_name' => 'updateServiceAuthorization2',
  'method' => 'PATCH',
  'path' => '/service-authorizations',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update service authorizations',
  'description' => 'Update service authorizations',
  'type' => 'write',
  'parameters' =>
  array (
    'request_body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `request_body`.',
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
  'body_param' => 'request_body',
  'body_required' => false,
);
}
